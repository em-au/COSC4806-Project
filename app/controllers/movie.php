<?php

class Movie extends Controller {
  
  public function index() {
    $this->view('movie/index');
  }

  // could add parameter movie title and then display results below search bar 
  public function search() {
    if (!isset($_REQUEST['movie'])) {
      header('location: /movie');
      die;
    }

    // TO DO: display error msg if no movie found
    // TO DO: what if multiple movies (eg inside out) - use s= instead of t=

    
    $api = $this->model('Api');
    $title = $_REQUEST['movie'];
    // Replace spaces in movie title with hyphen
    $title = str_replace(" ", "-", $title);
    $movie = $api->search_movie($title);

    // If movie is found, get ratings of the movie from the model
    if ($movie['Response'] != "False") {
      $ratings = $this->model('Rating');
      $rows = $ratings->getRatings($title);
      // Format the date
      foreach ($rows as &$row) {
        $timestamp = strtotime($row['date_added']);
        $row['date_added'] = date("F j, Y", $timestamp);
      }
    }
    
    $this->view('movie/result', ['movie' => $movie, 'ratings' => $rows]);
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
      header('location: ' . $_SERVER['HTTP_REFERER']); // goes back to /movie with search bar, not result
    }
  
}
