<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $data = $user->test();

      $reminder = $this->model('Reminder');
      $num_reminders = $reminder->get_num_reminders($_SESSION['user_id']);
      $this->view('home/index', ['num_reminders' => $num_reminders]);
      die;
    }

}
