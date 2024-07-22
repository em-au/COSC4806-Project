<?php require_once 'app/views/templates/headerAll.php'?> <!-- CHANGE HEADER -->

<style>
    .container-main {
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center; 
        text-align: center;
        padding: 0px 120px;
        margin-top: 40px;
        gap: 30px;
    }

    .title {
        color: #f0327b;
    }
    .btn-secondary {
        background-color: white;
    }

    .card {
        border: none;
        color: #e8e8e8;
        background-color: red;
        background: linear-gradient(to bottom right, #202021, #353536);
    }

    .no-movie {
        color: #f25058;
        margin-top: 2px;
    }
</style>
<div class="container container-main">
    <h1 class="title">Film Rate</h1>
    <div class="row">
      <div class="col-sm-auto"> <!-- can try col-8 and center -->
        <form action="/movie/search" method="post" style="width: 300px">
          <fieldset>
            <div class="form-group d-flex gap-2 style="text-align: left">
              <input required type="text" class="form-control" name="movie" placeholder="Search for a movie">
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-magnifying-glass" style="color: #f0327b;"></i></button>
              
            </div>
            <? if (isset($_SESSION['no_movie'])) { ?>
              <span class="no-movie">Sorry we couldn't find that movie. Please try another movie!</span>
            <? unset($_SESSION['no_movie']); } ?>
          </fieldset>
        </form>
        <?php
          if (isset($_SESSION['no_movie'])) { ?>
            <br>
            <br>
            <div class="alert alert-warning" role="alert">
                No movie found!
            </div>
          <? }
          unset($_SESSION['no_movie']);
        ?>
      </div>
    
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card h-100">
          <div class="card-body" style="text-align: center">
            <div class="d-flex justify-content-center" style="margin-bottom: 16px"><i class="fa-solid fa-magnifying-glass fa-3x" style="color: #f0327b;"></i></div>
            <h5 class="card-title">Search for movies</h5>
            <p class="card-text">
                Look up your favourite movies and see more information</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body" style="text-align: center">
            <div class="d-flex justify-content-center" style="margin-bottom: 16px"><i class="fa-solid fa-star fa-3x" style="color: #f0327b;"></i></div>
            <h5 class="card-title">Rate movies</h5>
            <p class="card-text">Keep track of what you thought about movies and see other users' ratings</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body" style="text-align: center">
            <div class="d-flex justify-content-center" style="margin-bottom: 16px"><i class="fa-solid fa-pen fa-3x" style="color: #f0327b;"></i></div>
            <h5 class="card-title">Read movie reviews</h5>
            <p class="card-text">Read what movie critics had to say about a movie</p>
          </div>
        </div>
      </div>
    </div>

</div>

<?php require_once 'app/views/templates/footer.php' ?>
