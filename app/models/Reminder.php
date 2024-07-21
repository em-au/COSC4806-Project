<?php

class Reminder {

  public function __construct() {

  }

  public function get_all_reminders() {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = :user_id;");
    $statement->bindParam(':user_id', $_SESSION['user_id']);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function get_incomplete_reminders() {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = :user_id AND deleted = 0 AND completed = 0;");
    $statement->bindParam(':user_id', $_SESSION['user_id']);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function get_completed_reminders() {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = :user_id AND completed = 1 ORDER BY completed_at DESC");
    $statement->bindParam(':user_id', $_SESSION['user_id']);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function get_reminder_by_id($id) {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM reminders WHERE id = :id;");
    $statement->bindParam(':id', $id);
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    return $rows;
  }
  
  public function add_reminder($subject) {
    $db = db_connect();
    $statement = $db->prepare("INSERT INTO reminders (user_id, subject) VALUES (:user_id, :subject)");
    $statement->bindParam(':user_id', $_SESSION['user_id']);
    $statement->bindParam(':subject', $subject);
    $statement->execute();
  }
  
  public function edit_reminder($id, $subject) {
    $db = db_connect();
    $statement = $db->prepare("UPDATE reminders SET subject = :subject WHERE id = :id");
    $statement->bindParam(':subject', $subject);
    $statement->bindParam(':id', $id);
    $statement->execute();
  }

  public function mark_reminder_deleted($id) {
    $db = db_connect();
    $statement = $db->prepare("UPDATE reminders SET deleted = 1 WHERE id = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
  }

  public function mark_reminder_completed($id) {
    $db = db_connect();
    $statement = $db->prepare("UPDATE reminders SET completed = 1, completed_at = current_timestamp() WHERE id = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
  }

  public function get_num_reminders($id) { // Incomplete reminders
    $db = db_connect();
    $statement = $db->prepare("SELECT COUNT(*)
      FROM reminders
      WHERE deleted = 0 AND completed = 0 AND user_id = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    return $rows['COUNT(*)'];
  }

  // Admin functions
  public function get_all_reminders_for_admin() {
    $db = db_connect();
    $statement = $db->prepare("SELECT u.username, r.subject, r.completed, r.created_at 
      FROM reminders AS r 
      INNER JOIN users as u 
      ON r.user_id = u.id 
      WHERE r.deleted = 0 
      ORDER BY r.created_at DESC");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function get_users_by_num_reminders() { // Incomplete + complete reminders
    $db = db_connect();
    $statement = $db->prepare("SELECT u.username, COUNT(r.id) AS 'Number of Reminders'
      FROM reminders AS r
      INNER JOIN users as u
      ON r.user_id = u.id
      WHERE r.deleted = 0
      GROUP BY u.username
      ORDER BY COUNT(r.id) DESC");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}
?>