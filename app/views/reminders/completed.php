<?php require_once 'app/views/templates/header.php' ?>

<div class="container" style="margin-top: 5px">
    <div class="col-lg-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/reminders">
                <? echo ucwords($_SESSION['controller'])?></a></li>
              <li class="breadcrumb-item active" aria-current="page">
              <? echo ucwords(str_replace("_", " ", $_SESSION['method']))?></li>
          </ol>
        </nav>
    </div>
</div>

<div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
    <div style="width:700px">
    <div class="page-header" id="banner">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2>Completed Reminders</h2>
            </div>
            <div >
                <a href="/reminders"><button type="button" class="btn btn-outline-primary">Return to current reminders</button></a>
            </div>
        </div>
    </div>
    <br>
    <?php 
        if (empty($data['reminders'])) { ?>
            <div class="alert alert-warning" role="alert">You have no completed reminders!</div>
        <? }
        else { ?>
            <table class="table align-middle" style="width:700px; text-align: left">
                <tr>
                    <th>Reminder</th>
                    <th>Created</th>
                    <th>Completed</th>
                </tr>
        <? } ?>
    <?php
        foreach($data['reminders'] as $reminder) { ?>
        <tr>
            <td style="width:300px"><?php echo $reminder['subject']; ?></td>
            <td><?php echo $reminder['created_at']; ?></td>
            <td><?php echo $reminder['completed_at']; ?></td>
        </tr>

        <? } ?>

    </table>
    </div>
</div>
<?php require_once 'app/views/templates/footer.php' ?>