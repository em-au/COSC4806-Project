<?php
// THIS MOVED TO API MODEL
// class Omdb extends Controller {

//   public function index() {
//     $query_url = "http://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=barbie";

//     $json = file_get_contents($query_url);
//     $phpObj = json_decode($json);
//     $movie =  (array) $phpObj;

//     echo "<pre>";
//     print_r ($movie);
//     die;

//   }
// }