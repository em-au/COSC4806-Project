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

	.signup-success {
		color: green;
	}
	
	.login-error {
		color: #f0327b;
	}
</style>

<div class="container container-main">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Login</h2>
            </div>
        </div>
    </div>

<?php
	if ($_SESSION['account_created'] == 1) { ?>
			<span class="signup-success">Account created! Please login.</span>
	<?php }
	
	// Unset variable so message doesn't stick around (eg when refreshing page)
	unset($_SESSION['account_created']);
	echo "\n\n";
?>

<div class="row">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" style="width: 300px">
		<fieldset>
			<div class="form-group" style="text-align: left">
				<label for="username">Username</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group" style="text-align: left">
				<label for="password">Password</label>
				<input required type="password" class="form-control" name="password">
			</div>
			
			<?php // Display error messages
			if (isset($_SESSION['username_exists']) && ($_SESSION['username_exists'] == 0) || isset($_SESSION['password_incorrect'])) { ?>
					<span class="login-error">Incorrect username or password</span>
			 <?php }
				 unset($_SESSION['username_exists']);
				 unset($_SESSION['password_incorrect']); 
			?>
			<br>	
				 
			<button type="submit" class="btn btn-secondary border-0" 
				<?php 
				if (isset($_SESSION['locked']) && !(time() > $_SESSION['lock_end'])) { ?> disabled <?php } ?>>Login</button>
			<br>
		</fieldset>
		</form> 
	</div>
</div>
<br>
<a href="/create">Don't have an account? Sign up now.</a>

<?php
	if (isset($_SESSION['locked']) && !(time() > $_SESSION['lock_end'])) { ?>
		<br>
		<br>
		<div class="alert alert-danger" role="alert">
				You have been locked out for 60 seconds. Please refresh the page and try again later.
		</div>
	<?php }
	else {
		unset($_SESSION['locked']);
	}
?>

	<?php
		if (isset($_SESSION['login_to_rate'])) { ?>
			<br>
			<br>
			<div class="alert alert-warning" role="alert">
					You must be logged in to leave a rating!
			</div>
		<? }
		unset($_SESSION['login_to_rate']);
	?>
	
<br>
</div>
</div>
<?php require_once 'app/views/templates/footer.php' ?>
