<?php

class Log {

  public $username;
  public $success;
  public $time;
  public $current_fails = 0;

  public function __construct() {

  }

  // Adds the login attempt to Logs table in database
  public function log_attempt($username, $success, $time) {
    $db = db_connect();
    $statement = $db->prepare("INSERT INTO logs (username, success, time) VALUES (:username, :success, :time)");
    $statement->bindParam(':username', $username);
    $statement->bindParam(':success', $success);
    $statement->bindParam(':time', $time);
    $statement->execute();
  }

  public function count_fails($username) { 
    $db = db_connect();
    $statement = $db->prepare("SELECT COUNT(*) FROM (SELECT * FROM logs WHERE username = :username AND success = 0 AND time > :time) AS temp"); // subquery            
    $statement->bindParam(':username', $username);
    $statement->bindParam(':time', $this->success_time($username));
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);                                        
    $this->current_fails = $rows['COUNT(*)'];                                              
  }

  // Get time of last successful attempt (used as a way to reset counter for failed attempts)
  public function success_time($username) {
    $db = db_connect();
    $statement = $db->prepare("SELECT time FROM logs WHERE username = :username AND success = 1 ORDER BY time DESC LIMIT 1");
    $statement->bindParam(':username', $username);
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
      return $rows['time'];
    }
    else {
      /* If array is empty, then user has never made a successful login and so 
      the count of failed attempts since last successful login would always be 0
      so return a default time 
      */
      return strtotime('1970-01-01 00:00:00');
    }
  }

  // Retrieve time of the last failed attempt
  public function lock_time($username) {
    $db = db_connect();
    $statement = $db->prepare("SELECT time FROM logs WHERE username = :username AND success = 0 ORDER BY time DESC LIMIT 1");
    $statement->bindParam(':username', $username);
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    $this->time = $rows['time'];
  }

  public function get_num_logins() {
    $db = db_connect();
    $statement = $db->prepare("SELECT username, COUNT(username) AS 'Number of Logins'
      FROM logs
      WHERE success = 1
      GROUP BY username
      ORDER BY username");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}
?>