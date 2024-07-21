<?php

class Api {

  public function search_movie($title) {
    $query_url = "http://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=" . $title;

    $json = file_get_contents($query_url);
    $phpObj = json_decode($json);
    $movie =  (array) $phpObj;
    return $movie;
  }
  
}