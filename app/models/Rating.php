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
}