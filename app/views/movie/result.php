<?php require_once 'app/views/templates/headerAll.php' ?> <!-- CHANGE HEADER -->
<style>
    .container {
        padding: 0px;
    }
    
    .container-main {
        margin-top: 30px;
    }

    .movie-info {
        gap: 50px;
        padding: 0px;
    }

    .movie-year {
        font-size: 20px;
    }

    .movie-plot {
        font-size: 18px;
    }

    .movie-small {
        font-size: 12px;
    }

    .stars {
        margin-top: 10px;
        margin-bottom: 40px;
    }

    .card {
        margin-bottom: 5px;
        background-color: transparent;
        color: #e8e8e8;
        border: none;
    }

    .user-ratings {
        gap: 10px;
    }

    .rating-date {
        font-size: 12px;
    }

</style>


<div class="container container-main d-flex flex-column justify-content-between gap-5">
<div class="row">
    <div class="movie-info d-flex justify-content-center"> <!-- use col for responsiveness-->
        <?php $movie = $data['movie']; ?>
        <div class="movie-image">
            <img src="<?php echo $movie['Poster']?>">
        </div>
        <div class="movie-info">
            <h2><?php echo $movie['Title']?></h2>
            <div class="movie-year"><?php echo $movie['Year']?></div>
            <div><?php echo "Directed by " . $movie['Director']?></div>
            <div><?php echo "Starring " . $movie['Actors']?></div>
            <div class="movie-plot"><?php echo $movie['Plot']?></div>
            <br>
            <div class="movie-small">
                <?php echo $movie['Genre'] . "<br>" . $movie['Runtime'] ?>
            </div>
        </div>

        <div class="movie-rating col-3 d-flex flex-column justify-content-center align-items-center">
            <? if (empty($data['user_rating'])) { echo "<h5>Rate this movie</h5>"; } else { echo "<h5>You rated this</h5>"; } ?>
            <div class="stars">
                <a href="/movie/rating/<?php echo $movie['Title']?>/1">
                    <? if ($data['user_rating'] < 1) { ?>
                        <i class="fa-regular fa-star fa-2xl" style="color: #f0327b"></i><? }
                    else { ?><i class="fa-solid fa-star fa-2xl" style="color: #f0327b;"></i><? } ?></a>
                <a href="/movie/rating/<?php echo $movie['Title']?>/2">
                    <? if ($data['user_rating'] < 2) { ?>
                        <i class="fa-regular fa-star fa-2xl" style="color: #f0327b"></i><? }
                    else { ?><i class="fa-solid fa-star fa-2xl" style="color: #f0327b;"></i><? } ?></a>
                <a href="/movie/rating/<?php echo $movie['Title']?>/3">
                    <? if ($data['user_rating'] < 3) { ?>
                        <i class="fa-regular fa-star fa-2xl" style="color: #f0327b"></i><? }
                    else { ?><i class="fa-solid fa-star fa-2xl" style="color: #f0327b;"></i><? } ?></a>
                <a href="/movie/rating/<?php echo $movie['Title']?>/4">
                    <? if ($data['user_rating'] < 4) { ?>
                        <i class="fa-regular fa-star fa-2xl" style="color: #f0327b"></i><? }
                    else { ?><i class="fa-solid fa-star fa-2xl" style="color: #f0327b;"></i><? } ?></a>
                <a href="/movie/rating/<?php echo $movie['Title']?>/5">
                    <? if ($data['user_rating'] < 5) { ?>
                        <i class="fa-regular fa-star fa-2xl" style="color: #f0327b"></i><? }
                    else { ?><i class="fa-solid fa-star fa-2xl" style="color: #f0327b;"></i><? } ?></a>
            </div>
            <div class="scores d-flex gap-4">
                <div class="score d-flex flex-column align-items-center">
                    <div><?php 
                        echo $movie['imdbRating'] . "/10";
                     ?></div>
                    <div>IMDb</div>
    
                </div>
                <div class="score d-flex flex-column align-items-center">
                    <div><?php 
                        echo $movie['Metascore'] . "/100";
                     ?></div>
                    <div>Metascore</div>
                </div>
            </div>
        </div>
    </div>
</div>
              
<div class="row">
    <div class="container ratings-reviews d-flex gap-5">
        <div class="col-8 user-ratings d-flex flex-column">
            <h5>What critics have said about this movie</h5>
            <?php
                foreach ($data['reviews'] as $review) { ?>
                   <span class="border-bottom"></span>
                   <div class="card">
                     <div class="card-body">
                       <? echo "<p>$review</p>"; ?>
                     </div>
                   </div>
                    <?

                }
            ?> 
        </div>
        
        <div class="col-4 user-ratings d-flex flex-column">
            <h5>User Ratings</h5>
            <?php 
                // No user ratings for this movie
                if (empty($data['ratings'])) {
                    echo "There are no ratings for this movie.";
                }
                else {
                    foreach ($data['ratings'] as $rating) { ?>
                       <div class="single-user-rating">
                            <div class="user-rating-item"><? echo $rating['username']?></div>
                            <div class="user-rating-item rating-date"><? echo $rating['date_added']?></div>
                            <div class="user-rating-item stars-group d-flex">              
                                <?php
                                    for ($i = 0; $i < $rating['rating']; $i++) { ?>
                                        <i class="fa-solid fa-star" style="color: #f0327b;"></i> 
                                    <? } ?> 
                                <br>
                            </div>
                       </div>
                <? }
                } 
            ?>
        </div>
    </div>
</div>
    
</div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>