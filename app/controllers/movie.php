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

    // A movie was found
    if ($movie['Response'] != "False") {
      // Get ratings from all users for this movie
      $all_ratings = $this->get_ratings($movie['Title']);

      // Get the current user's rating of the movie 
      $user_rating = $this->get_user_rating($movie['Title']);

      // Get AI-generated reviews of the movie
      $reviews = $this->get_reviews($movie['Title']);
    }
    else if ($movie['Response'] == "False") {
      // SHOW ERROR MESSAGE NICELY
    }

    $this->view('movie/result', ['movie' => $movie, 
                'ratings' => $all_ratings, 
                'user_rating' => $user_rating,
                'reviews' => $reviews]);
  }

    public function rating($movie = '', $rating = '') {
      // If user is not logged in, redirect to Login page
      if (!isset($_SESSION['auth'])) {
        header('location: /login');
        $_SESSION['login_to_rate'] = 1;
        die;
      }

      $user_rating = $this->model('Rating');

      // If user has already rated this movie, delete the old rating first
      if ($user_rating->getUserRating($movie, $_SESSION['user_id'])) {
        $user_rating->delete_rating($_SESSION['user_id'], $movie);
      }
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

    public function get_user_rating($movie) {
      $user_rating = $this->model('Rating');
      $row = $user_rating->getUserRating($_SESSION['user_id'], $movie);
      return $row['rating'];
    }

    public function get_ratings($movie) {
      $ratings = $this->model('Rating');
      $rows = $ratings->getRatings($movie);
      // Format the date
      foreach ($rows as &$row) {
        $timestamp = strtotime($row['date_added']);
        $row['date_added'] = date("F j, Y", $timestamp);
      }
      return $rows;
    }

    public function get_reviews($movie) {
      $api = $this->model('Api');
  
      // Options for overall opinion of the movie
      $movie_opinions = array("amazing", "good", "average", "bad", "awful", 
                            "boring", "interesting");
  
      // Get random number of reviews to generate
      $num_reviews = rand(2,4);
      for ($i = 0; $i < $num_reviews; $i++) {
        $response = $api->get_review($movie, $movie_opinions[rand(0,6)]);
  
        // Grab only the text part of the response
        $review_text = $response['candidates'][0]['content']['parts'][0]['text'];
        $reviews[$i] = $review_text;
      }
  
      return $reviews; // Return an array with the generated reviews
    }
  
    public function result() {
      
    }
  
}
