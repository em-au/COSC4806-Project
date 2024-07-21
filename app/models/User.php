<?php

class User {

  public $username;
  public $password;
  public $is_authenticated = false;

  public function __construct() {
      
  }

  public function test () {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM users;");
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function authenticate($username, $password) {
      /*
       * if username and password good then
       * $this->is_authenticated = true;
       */
    $_SESSION['username'] = $username;
    $username = strtolower($username);
    $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (password_verify($password, $rows['password'])) {
      $this->is_authenticated = true;
      $_SESSION['user_id'] = $rows['id'];
      if ($rows['admin'] == 1) { // Check if user is admin
        $_SESSION['admin'] = 1;
      }
    }
    
  }

  // Check if username exists in the Users table in database
  public function check_username_exists($username) {
    $db = db_connect();
    $statement = $db->prepare("SELECT username FROM users WHERE username = :username");
    $statement->bindValue(':username', $username);
    $statement->execute(); 
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($row)) { 
      $_SESSION['username_exists'] = 1;
    }
    else {
      $_SESSION['username_exists'] = 0;
    }
  }

  // Add new user to the Users table
  public function add_user($username, $password) {
    $db = db_connect();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $hashed_password);
    $statement->execute();
  }

}
