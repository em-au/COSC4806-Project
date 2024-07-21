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

    // If movie is found, get ratings of the movie from the model --> MOVE TO SEPARATE FXN?
    if ($movie['Response'] != "False") {
      $ratings = $this->model('Rating');
      $rows = $ratings->getRatings($title);
      // Format the date
      foreach ($rows as &$row) {
        $timestamp = strtotime($row['date_added']);
        $row['date_added'] = date("F j, Y", $timestamp);
      }

      // Get the user's rating of this movie (if any) 
      $user_rating = $this->user_rating($movie['Title']);
      
    }

    // If movie is found, generate reviews of the movie --> MOVE TO SEPARATE FXN?
    //$api = $this->model('Api');
    $movie_for_review = $movie['Title'];
    $movie_opinions = array("amazing", "good", "average", "bad", "awful", 
    "boring", "interesting");

    // Get random number of reviews
    $num_reviews = rand(2,5);
    for ($i = 0; $i < $num_reviews; $i++) {
      $response = $api->get_review($movie_for_review, $movie_opinions[rand(0,6)]);
      // Grab only the text part of the response
      $review_text = $response['candidates'][0]['content']['parts'][0]['text'];
      $reviews[$i] = $review_text;
    }

    $this->view('movie/result', ['movie' => $movie, 
                'ratings' => $rows, 
                'user_rating' => $user_rating,
                'reviews' => $reviews]);
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
      // If user is not logged in, redirect to Login page
      if (!isset($_SESSION['auth'])) {
        header('location: /login');
        $_SESSION['login_to_rate'] = 1;
        die;
      }

      $user_rating = $this->model('Rating');
      // urldecode() to handle any spaces in movie title
      $title = urldecode($movie);
      $user_rating->add_rating($_SESSION['user_id'], $title, $rating);
      // want this to redirect back to search result page and not /movie/rating/title/4
      //header('location: /movie/result'); // goes back to /movie with search bar, not result
      $api = $this->model('Api');
      // Replace spaces in movie title with hyphen
      //$title = str_replace(" ", "-", $title);
      $movie = $api->search_movie($title);
      //echo "<pre>";
      //print_r($movie); die; // doesnt' work if spaces are %20
      
        // If movie is found, get ratings of the movie from the model --> MOVE TO SEPARATE FXN?
        if ($movie['Response'] != "False") {
          //$ratings = $this->model('Rating');
          $rows = $user_rating->getRatings($title);
          // Format the date
          foreach ($rows as &$row) {
            $timestamp = strtotime($row['date_added']);
            $row['date_added'] = date("F j, Y", $timestamp);
          }
        } 
      
        //If movie is found, generate reviews of the movie --> MOVE TO SEPARATE FXN?
        $api = $this->model('Api');
        $movie_for_review = $movie['Title']; // can change to $title
        $movie_opinions = array("amazing", "good", "average", "bad", "awful", 
        "boring", "interesting");

        // Get random number of reviews
        $num_reviews = rand(2,4);
        for ($i = 0; $i < $num_reviews; $i++) {
          $response = $api->get_review($movie_for_review, $movie_opinions[rand(0,6)]);
          // Grab only the text part of the response
          $review_text = $response['candidates'][0]['content']['parts'][0]['text'];
          $reviews[$i] = $review_text;
        }

      $this->view('movie/result', ['movie' => $movie, 'ratings' => $rows, 'reviews' => $reviews]);
    }

    public function reviews($movie = '') {
      
      //$this->view('movie/result', ['reviews' => $reviews]);
    }

    public function user_rating($movie) {
      $user_rating = $this->model('Rating');
      $row = $user_rating->getUserRating($movie, $_SESSION['user_id']);
      return $row['rating'];
    }
  
}
