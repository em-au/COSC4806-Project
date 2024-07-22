<?php require_once 'app/views/templates/headerPublic.php'?>
<style>
    .container-main {
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center; 
        text-align: center; 
        min-height: 80vh;
    }

    .btn-secondary {
        background-color: #f0327b;
        border: none;
    }

    a {
        color: #944b4f
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>

<div class="container container-main">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Create an account</h2>
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
            <button type="submit" class="btn btn-secondary border-0">Sign up</button>
        </fieldset>
        </form> 
  </div>
</div>
<br>
<a href="/login">Already have an account? Log in here.</a>

</div>
<?php require_once 'app/views/templates/footer.php' ?>
    
