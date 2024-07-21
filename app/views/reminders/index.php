<?php require_once 'app/views/templates/header.php' ?>

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
<div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
    
    <div style="width:600px">
    <div class="page-header" id="banner" >
        <div style="display: flex; align-items: center; justify-content: space-between">
            <div>
                <h2>Reminders</h2>
            </div>
            <div >
                <a href="/reminders/completed_reminders"><button type="button" class="btn btn-outline-primary">Completed reminders</button></a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                  Add
                </button>
            </div>
        </div>
    </div>
    <br>

    <table class="table align-middle bottom-bordered"> 
    <?php
        if (empty($data['reminders'])) { ?>
            <div class="alert alert-warning" role="alert">You currently have no reminders!</div>
        <? }
        foreach($data['reminders'] as $reminder) { ?>
        <tr>
            <td align="left" style="width:400px"><?php echo $reminder['subject']; ?></td>
            <td align="right" style="width: 200px;">
                <a href="/reminders/update_form/?id=<?php echo $reminder['id']; ?>"><button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-pencil"></i></button></a>
                <a href="/reminders/complete/?id=<?php echo $reminder['id']; ?>"><button type="button" class="btn btn-outline-success"><i class="fa-solid fa-check"></i></button></a>
                <a href="/reminders/delete/?id=<?php echo $reminder['id']; ?>"><button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button></a>
            </td>
        </tr>
        <? } ?>

    </table>
    </div>
</div>

<!-- Modal to add a reminder -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Reminder</h1>
      </div>
      <div class="modal-body">
          <form action="/reminders/create_reminder" method="post">
          <fieldset>
              <div class="form-group" style="text-align: left">
                  <input required type="text" class="form-control" name="subject" placeholder="Description">
              </div>
              <br>
              <div style="text-align: right">
              <a href="/reminders"><button type="button" class="btn btn-light">Cancel</button></a>
              <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </fieldset>
          </form> 
      </div>
    </div>
  </div>
</div>

<!-- Modal to update a reminder 
Requires a page refresh to get data (reminder's subject) from controller
to prepopulate the form -->
<div class="modal fade" id="updateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Reminder</h1>
      </div>
      <div class="modal-body">
          <form action="/reminders/update_reminder/?id=<?php echo $data['reminder']['id']; ?>" method="post">
          <fieldset>
              <div class="form-group" style="text-align: left">
                  <input required type="text" class="form-control" name="subject" value="<? echo $data['reminder']['subject'] ?>" placeholder="Description">
              </div>
              <br>
              <div style="text-align: right">
                <a href="/reminders"><button type="button" class="btn btn-light">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
          </fieldset>
          </form> 
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>

<script>
    <? if ($data['showUpdateModal'] == true) { ?>
        var myModal = new bootstrap.Modal(document.getElementById('updateModal'), {})
        myModal.toggle()
    <? } ?>
</script>