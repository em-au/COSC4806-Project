    <?php require_once 'app/views/templates/header.php'?>
    <main role="main" class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; min-height: 80vh;">
        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Edit reminder</h2>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-sm-auto">
            <form action="/reminders/update_reminder/?id=<?php echo $data['reminder']['id']; ?>" method="post" style="width: 500px;">
            <fieldset>
                <div class="form-group" style="text-align: left">
                    <input required type="text" class="form-control" name="subject" value="<? echo $data['reminder']['subject'] ?>" placeholder="Description">
                </div>
                <br>
                <a href="/reminders"><button type="button" class="btn btn-light">Cancel</button></a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
            </form> 
      </div>
    </div>
    <br>

<?php require_once 'app/views/templates/footer.php' ?>

