<?php require_once 'app/views/templates/header.php' ?>
<br>
<div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; min-height: 80vh;">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Search movie</h1>
            </div>
        </div>
    </div>

  <div class="row">
      <div class="col-sm-auto"> <!-- can try col-8 and center -->
        <form action="/movie/search" method="post" style="width: 300px">
          <fieldset>
            <div class="form-group" style="text-align: left">
              <input required type="text" class="form-control" name="movie" placeholder="Movie">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Search</button>
          </fieldset>
        </form>
      </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
