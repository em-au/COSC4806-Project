<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $data = $user->test();

      // test out gemini
      $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $_ENV['GEMINI'];
      

      $data = array(
        "contents" => array(
          array(
            "role" => "user",
            "parts" => array(
              array(
                "text" => 'Write a review for the movie Past Lives.'
              )
            )
          )
        )
      );

      $json_data = json_encode($data);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);
      if(curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
      }

      echo "<pre>";
      echo $response;
      die;
      
      $this->view('home/index');
    }

}
