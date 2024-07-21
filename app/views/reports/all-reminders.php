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
              <li class="breadcrumb-item" aria-current="page"><a href="/reports">
                  <? echo ucwords($_SESSION['controller'])?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <? echo ucwords(str_replace("_", " ", $_SESSION['method']))?></li>
          </ol>
        </nav>
    </div>
</div>

<div class="container" >
    <div>
    <div class="page-header" id="banner">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div class="d-flex" style="gap: 10px; margin-bottom: 10px">
                    <div class="btn-group">
                      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                          <i class="fa-solid fa-bars"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/reports">Reports</a></li>
                        <li><a class="dropdown-item disabled" aria-disabled="true">All Reminders</a></li>
                        <li><a class="dropdown-item" href="/reports/most_reminders">Users by Reminders</a></li>
                      <li><a class="dropdown-item" href="/reports/number_of_logins">Users by Logins</a></li>
                      </ul>
                    </div>
                    <div><h2 style="margin: 0px">All Reminders</h2></div>
            </div>
        </div>
    </div>
    <br>

    <?php 
        if (empty($data['reminders'])) { ?>
            <div class="alert alert-warning" role="alert">There are no reminders</div>
        <? }
        else { ?>
            <table class="table align-middle">
                <tr>
                    <th>Username</th>
                    <th>Reminder</th>
                    <th>Completed</th>
                    <th>Created</th>
                </tr>
        <? } ?>
    <?php
        foreach($data['reminders'] as $reminder) { ?>
        <tr>
            <td><?php echo $reminder['username']; ?></td>
            <td align="left"><?php echo $reminder['subject']; ?></td>
            <td><?php if ($reminder['completed'] == 1) { ?> <i class="fa-solid fa-check fa-lg" style="color: #00a372"></i>
              <? } else { ?> <i class="fa-solid fa-x fa-lg" style="color: #e63333;"></i> <? };?></td>
            <td><?php echo $reminder['created_at']; ?></td>
        </tr>

        <? } ?>

    </table>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>