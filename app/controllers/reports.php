<?php

class Reports extends Controller {

  public function index() {
    $this->view('reports/index');
  }

  public function all_reminders() {
    $reminder = $this->model('Reminder');
    $reminders = $reminder->get_all_reminders_for_admin();
    foreach($reminders as &$reminder) { // Convert timezone of the timestamps from database (UTC)
      $date_created = new DateTime($reminder['created_at'], new DateTimeZone("UTC"));
      $date_created->setTimezone(new DateTimeZone("America/Toronto"));
      $date_created = $date_created->format('F j, Y g:i a'); // Convert DateTime object to string
      $reminder['created_at'] = $date_created;
    }
    $this->view('reports/all-reminders', ['reminders' => $reminders]);
  }
  

  public function most_reminders() {
    $reminder = $this->model('Reminder');
    $reminders = $reminder->get_users_by_num_reminders();
    $this->view('reports/most-reminders', ['reminders' => $reminders]);
  }

  public function number_of_logins() {
    $log = $this->model('Log');
    $log = $log->get_num_logins();
    $this->view('reports/logins', ['logins' => $log]);
  }

}
?>