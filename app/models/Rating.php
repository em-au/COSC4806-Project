<?php

class Rating {

  public function add_rating($user_id, $movie, $rating) {
    $db = db_connect();
    $statement = $db->prepare("INSERT INTO ratings (user_id, movie, rating) VALUES (:user_id, :movie, :rating)");
    $statement->bindParam(':user_id', $user_id);
    $statement->bindParam(':movie', $movie);
    $statement->bindParam(':rating', $rating);
    $statement->execute();
  }

  // why am i suddenly using camelcase
  public function getRatings($movie) {
    $db = db_connect();
    $statement = $db->prepare("SELECT u.username, r.rating, r.date_added
      FROM ratings as r
      INNER JOIN users as u
      ON r.user_id = u.id
      WHERE movie = :movie
      ORDER BY r.date_added DESC");
    $statement->bindParam(':movie', $movie);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function getUserRating($movie, $user_id) {
    $db = db_connect();
    $statement = $db->prepare("SELECT rating FROM ratings WHERE user_id = :user_id AND movie = :movie");
    $statement->bindParam(':user_id', $user_id);
    $statement->bindParam(':movie', $movie);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row;
  }
}