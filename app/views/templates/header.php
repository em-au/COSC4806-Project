<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="icon" href="/favicon.png">
        <script src="https://kit.fontawesome.com/1a161933ae.js" crossorigin="anonymous"></script>
        <title>COSC 4806</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
    </head>
    <body style="display:flex; flex-direction: column; min-height: 100vh">
<nav class="navbar navbar-expand-lg" style="background-color: #bed7eb">
  <div class="container">
    <a class="navbar-brand" href="/">COSC 4806</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Reminders</a>
      </li>
      <?
        if (isset($_SESSION['admin'])) { ?>
          <li class="nav-item">
            <a class="nav-link active" href="#">Reports</a>
          </li>
      <? }
      ?>
      
    </ul>
    <div class="navbar-nav"><a class="nav-link active" href="/logout">Log out</a></div>
  </div>
</nav>
