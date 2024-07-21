<?php

class Create extends Controller {

  public function index() {		
    $this->view('create/index');
  }

  public function create_user() { 
    $username = $_REQUEST['username'];
    $password1 = $_REQUEST['password1'];
    $password2 = $_REQUEST['password2'];

    $user = $this->model('User');

    // Check if username exists
    $user->check_username_exists($username); 
    if ($_SESSION['username_exists'] == 1) {
      header('location: /create');
    }
      
    // Check if passwords match
    else if ($password1 != $password2) {
      $_SESSION['password_mismatch'] = 1;
      header ('location: /create');
    }

    // Check if password meets security standard (minimum 8 characters)
    else if (strlen($password1) < 8) {
      $_SESSION['password_too_short'] = 1;
      header ('location: /create');
    }
    else {
      // Passed all requirements
      // Call model to add user to Users table in database
      $user->add_user($username, $password1);
      $_SESSION['account_created'] = 1;
      unset($_SESSION['username_exists']);
      header('location: /login');
    }
  }
}
