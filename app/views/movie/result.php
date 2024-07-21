<?php 
    require_once 'app/views/templates/header.php';
    $movie = $data['movie']; 
?> <!-- CHANGE HEADER -->

<div class="container d-flex justify-content-center">
    <div class="container movie-image">
        <img src="<?php echo $movie['Poster']?>">
    </div>
    <div class="container movie-info">
        <h2><?php echo $movie['Title']?></h2>
        <div><?php echo $movie['Year']?></div>
        <div><?php echo "Directed by " . $movie['Director']?></div>
        <div><?php echo "Starring " . $movie['Actors']?></div>
        <div><?php echo $movie['Plot']?></div>
        <div><?php echo $movie['Runtime']?></div>
        <div><?php echo $movie['Genre']?></div>
        
    </div>
        
    <div class="container movie-rating d-flex flex-column justify-content-center align-items-center">
        <h5>Rate this movie</h5>
        <div class="stars"> <!-- Add the correct links 
            /movie/rating/?id=$movie['Title']/numstars
            what about hyphens in title? -->
            <a href="/movie/rating/<?php echo $movie['Title']?>/1">
                <i class="fa-regular fa-star fa-2xl"></i></a>
            <a href="/movie/rating/<?php echo $movie['Title']?>/2">
                <i class="fa-regular fa-star fa-2xl"></i></a>
            <a href="/movie/rating/<?php echo $movie['Title']?>/3">
                <i class="fa-regular fa-star fa-2xl"></i></a>
            <a href="/movie/rating/<?php echo $movie['Title']?>/4">
                <i class="fa-regular fa-star fa-2xl"></i></a>
            <a href="/movie/rating/<?php echo $movie['Title']?>/5">
                <i class="fa-regular fa-star fa-2xl"></i></a>
        </div>
        <div>
            <?php foreach ($movie['Ratings'] as $rating) {
                foreach ($rating as $key => $value) {
                    echo $value . " ";
                }
                echo "<br>";
            } ?>
        </div>
    </div>
    
    
</div>

<?php require_once 'app/views/templates/footer.php' ?>