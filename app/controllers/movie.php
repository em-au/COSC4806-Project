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
    // Replace spaces in movie title with hyphen to concatenate with OMDb API query URL
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
      $_SESSION['no_movie'] = 1;
      header('location: /movie');
      die;
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
      $movie_decoded = urldecode($movie); // Handle any spaces in movie title
      
      // If user has already rated this movie, delete the old rating first
      $row = $user_rating->getUserRating($_SESSION['user_id'], $movie_decoded);
      if (!empty($row)) {
        $user_rating->delete_rating($_SESSION['user_id'], $movie_decoded);
      }  

      // Check that the rating is an integer and between 1-5 (inclusive)
      if (!is_int($rating) || $rating < 1 || $rating > 5) {
        header('location: /movie');
        die;
      }

      // Add rating
      $user_rating->add_rating($_SESSION['user_id'], $movie_decoded, $rating);

      // Send user back to search results with updated information (ie their new rating)
      $api = $this->model('Api');
      $title = str_replace(" ", "-", $movie_decoded);
      $movie = $api->search_movie($title); // Use the movie title to grab the same movie from OMDb
      
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
        $_SESSION['no_movie'] = 1;
        header('location: /movie');
        die;
      }

      $this->view('movie/result', ['movie' => $movie, 
                  'ratings' => $all_ratings, 
                  'user_rating' => $user_rating,
                  'reviews' => $reviews]);
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

  public function my_ratings() {
    $ratings = $this->model('Rating');
    $rows = $ratings->get_user_all_ratings($_SESSION['user_id']);
    $this->view('movie/my_ratings', ['ratings' => $rows]);
  }

}
