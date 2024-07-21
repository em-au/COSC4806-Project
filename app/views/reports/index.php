<?php 
   ob_start();
    require_once 'app/views/templates/header.php'; 
    if (!isset($_SESSION['admin'])) {
        header('location: /home');
        ob_end_flush();
        die;
    }
?>

<div class="container" style="margin-top: 5px">
    <div class="col-lg-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <? echo ucwords($_SESSION['controller'])?></li>
          </ol>
        </nav>
    </div>
</div>

<div class="container" style="margin-top: 5%">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card h-100">
          <div class="card-body" style="text-align: center">
            <div class="d-flex justify-content-center" style="margin-bottom: 16px"><i class="fa-solid fa-bell fa-3x"></i></div>
            <h5 class="card-title">All Reminders</h5>
            <p class="card-text">
                Click the button below to see complete and incomplete reminders by all users</p>
            <a href="/reports/all_reminders"><button type="button" class="btn btn-primary">
                See all reminders</button></a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body" style="text-align: center">
            <div class="d-flex justify-content-center" style="margin-bottom: 16px"><i class="fa-solid fa-user fa-3x"></i></div>
            <h5 class="card-title">Users by Reminders</h5>
            <p class="card-text">Click the button below to see users sorted by number of reminders.</p>
          <a href="/reports/most_reminders"><button type="button" class="btn btn-primary">
          See users</button></a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-body" style="text-align: center">
            <div class="d-flex justify-content-center" style="margin-bottom: 16px"><i class="fa-solid fa-right-to-bracket fa-3x"></i></div>
            <h5 class="card-title">Users by Logins</h5>
            <p class="card-text">Click the button below to see users by number of logins.</p>
          <a href="/reports/number_of_logins"><button type="button" class="btn btn-primary">
            See logins</button></a>
          </div>
        </div>
      </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>