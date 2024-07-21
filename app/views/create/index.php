<?php require_once 'app/views/templates/headerPublic.php'?>
<div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; min-height: 80vh;">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Create an account</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
        <form action="/create/create_user" method="post" style="width: 300px;">
        <fieldset>
            <div class="form-group" style="text-align: left">
                <label for="username">Username</label>
                <input required type="text" class="form-control" name="username">
            </div>
            <div class="form-group" style="text-align: left">
                <label for="password">Password</label>
                <input required type="password" class="form-control" name="password1">
            </div>
            <div class="form-group" style="text-align: left">
                <label for="password">Confirm Password</label>
                <input required type="password" class="form-control" name="password2">
              </div>
            <?php // Display error messages
            if (isset($_SESSION['username_exists']) && $_SESSION['username_exists'] == 1) { ?>
              <span style="color: red">Username already taken</span>
            <?php }
            else if ($_SESSION['password_mismatch'] == 1) { ?>
                <span style="color: red">Passwords do not match</span>
              <?php }
              else if ($_SESSION['password_too_short'] == 1) { ?>
                <span style="color: red">Password must be at least 8 characters</span>
              <?php }
                // Unset variables so error messages don't persist
                unset($_SESSION['username_exists']);
                unset($_SESSION['password_mismatch']);
                unset($_SESSION['password_too_short']);
                ?>
            <br>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </fieldset>
        </form> 
  </div>
</div>
<footer>
    <br>
    <a href="/login">Already have an account? Log in here.</a>
</footer>
<br>
</div>
<?php require_once 'app/views/templates/footer.php' ?>
    
