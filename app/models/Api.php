<?php

class Api {

  public function search_movie($title) {
    $query_url = "http://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=" . $title;

    $json = file_get_contents($query_url);
    $phpObj = json_decode($json);
    $movie =  (array) $phpObj;
    return $movie;
  }

  public function get_review($title, $opinion) {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $_ENV['GEMINI'];

    $data = array(
      "contents" => array(
        array(
          "role" => "user",
          "parts" => array(
            array(
              "text" => 'Write a very short review for the movie ' . $title . 
                ' as someone who thought the movie was' . $opinion 
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

    // Convert response to associative array
    $review = json_decode($response, true);
    return $review;
  }

  public function get_name() {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $_ENV['GEMINI'];

    $data = array(
      "contents" => array(
        array(
          "role" => "user",
          "parts" => array(
            array(
              "text" => 'Give a random full name and name of a publication or media or movie company. Format it with a comma separating the full name and the company name.'
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

    // Convert response to associative array
    $review = json_decode($response, true);
    return $review;
  }

}