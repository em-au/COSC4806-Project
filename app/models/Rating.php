<?php

class Rating {

  public function addRating($user_id, $movie, $rating) {
    $db = db_connect();
    $statement = $db->prepare("INSERT INTO ratings (user_id, movie, rating) VALUES (:user_id, :movie, :rating)");
    $statement->bindParam(':user_id', $user_id);
    $statement->bindParam(':movie', $movie);
    $statement->bindParam(':rating', $rating);
    $statement->execute();
  }
}