<?php

class Movie extends Controller {
  
  public function index() {
    $this->view('movie/index');
  }

  public function search() {
    if (!isset($_REQUEST['movie'])) {
      header('location: /movie');
      die;
    }

    $api = $this->model('Api');
    $title = $_REQUEST['movie'];
    // Replace spaces in movie title with hyphen
    $title = str_replace(" ", "-", $title);
    $movie = $api->search_movie($title);

    // echo "<pre>";
    // print_r($movie);
    // die;

    $this->view('movie/result', ['movie' => $movie]);
  }
    /*
    View example
    under search bar:
    search button
    Movie Details
    Rating - leave one --> a href="/movie/rating/barbie/4"
      link not a form - when user goes here, grab the movie title and rating number
      and add to db (ensure that number value is correct)
        save userid, movie name, rating
    */

    public function rating($movie = '', $rating = '') {
      $user_rating = $this->model('Rating');
      // urldecode() to handle any spaces in movie title
      $user_rating->addRating($_SESSION['user_id'], urldecode($movie), $rating);
      // want this to redirect back to search result page and not /movie/rating/title/4
    }
  
}
