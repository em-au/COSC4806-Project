<?php
  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="icon" href="/favicon.png">
        <script src="https://kit.fontawesome.com/1a161933ae.js" crossorigin="anonymous"></script>
        <title>Film Rate</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
    </head>
    <body style="display:flex; flex-direction: column; min-height: 100vh">
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/" style="color: #f0327b;">Film Rate</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/movie">My Ratings</a>
      </li>

    </ul>
    <?php if (isset($_SESSION['auth'])) { ?>
      <div class="navbar-nav"><a class="nav-link" href="/logout">Log out</a></div>
      <? }
      else { ?>
        <div class="navbar-nav"><a class="nav-link" href="/create">Sign up</a></div>
        <div class="navbar-nav"><a class="nav-link" href="/login">Login</a></div>
      <? } ?>
  </div>
</nav>

<style>
  body {
    background-color: #1e1e1f;
    color: #e8e8e8;
  }

  .navbar a, .nav-link {
    color: #e8e8e8;
  }

</style>