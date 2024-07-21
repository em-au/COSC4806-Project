<?php require_once 'app/views/templates/header.php' ?>
<br>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo "Hello, " . $_SESSION['username']; ?></h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="card">
      <div class="card-body" style="text-align: center">
       <div style="margin-bottom: 16px"><i class="fa-regular fa-bell fa-5x" style="color: #0d6efd"></i></div>
        <h5 class="card-title">Placeholder<h5>
        <a href="#" class="btn btn-primary">Get started now</a>
      </div>
    </div>
    
</div>

<?php require_once 'app/views/templates/footer.php' ?>
