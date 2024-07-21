<?php

class Reminders extends Controller {
  
  public function index() {
    $reminder = $this->model('Reminder');
    $reminders = $reminder->get_incomplete_reminders();
    $this->view('reminders/index', ['reminders' => $reminders]);
  }

  public function completed_reminders() {
    $reminder = $this->model('Reminder');
    $reminders = $reminder->get_completed_reminders();
    foreach($reminders as &$reminder) { // Convert timezone of the timestamps from database (UTC)
      $date_created = new DateTime($reminder['created_at'], new DateTimeZone("UTC"));
      $date_created->setTimezone(new DateTimeZone("America/Toronto"));
      $date_created = $date_created->format('F j, Y g:i a'); // Convert DateTime object to string
      $reminder['created_at'] = $date_created;
                                       
      $date_completed = new DateTime($reminder['completed_at'], new DateTimeZone("UTC"));
      $date_completed->setTimezone(new DateTimeZone("America/Toronto"));
      $date_completed = $date_completed->format('F j, Y g:i a'); // Convert DateTime object to string
      $reminder['completed_at'] = $date_completed;
    }
    $this->view('reminders/completed', ['reminders' => $reminders]);
  }

  public function create_form() {
    $this->view('reminders/create');
  }

  public function create_reminder() {
    $subject = $_REQUEST['subject'];
    $reminder = $this->model('Reminder');
    $reminder->add_reminder($subject);
    header('location: /reminders');
  }

  public function update_form() {
    $id = $_GET['id'];
    $r = $this->model('Reminder');
    $reminders = $r->get_incomplete_reminders();
    $reminder = $r->get_reminder_by_id($id);
    if (!($this->is_valid_operation($id))) {
      header('location: /reminders'); die; 
    }
    // Pass the subject to prepopulate the form
    $this->view('reminders/index', ['reminder' => $reminder, 
                'reminders' => $reminders, 
                'showUpdateModal' => true]); 
  }

  public function update_reminder() { 
    $id = $_REQUEST['id'];
    $subject = $_REQUEST['subject'];
    $reminder = $this->model('Reminder');
    if (!($this->is_valid_operation($id))) {
      header('location: /reminders'); die; 
    }
    $reminder->edit_reminder($id, $subject);
    header('location: /reminders');
  }

  public function delete() { 
    $id = $_GET['id'];
    $r = $this->model('Reminder');
    if (!($this->is_valid_operation($id))) {
      header('location: /reminders'); die; 
    }           
    $r->mark_reminder_deleted($id);
    header('location: /reminders');                        
  }

  public function complete() {
    $id = $_GET['id'];
    $r = $this->model('Reminder');                      
    if (!($this->is_valid_operation($id))) {
      header('location: /reminders'); die; 
    }
    $r->mark_reminder_completed($id);
    header('location: /reminders'); 
  }

  // Check if reminder exists and if it belongs to the user performing operation
  public function is_valid_operation($id) {
    $r = $this->model('Reminder');
    $reminder = $r->get_reminder_by_id($id);
    if (empty($reminder) || $reminder['user_id'] != $_SESSION['user_id']) {
      return false;
    }
    else {
      return true;
    }
  }
}

?>