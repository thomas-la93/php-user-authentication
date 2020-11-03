<?php require(__DIR__ . "/../../layout/header.php"); ?>

<br /> <br />

<h3>Post erstellen</h3>



<form method="POST" action="posts-new" class="">
  <div class="form-group">
    <label class="control-label col-md-3">
      Titel:
    </label>
    <div class="col-md-9">
      <input type="text" name="title" value="<?php echo e($entry->title); ?>" class="form-control" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3">
      Inhalt:
    </label>
    <div class="col-md-9">
      <textarea name="content" class="form-control" rows="10"><?php echo e($entry->content); ?></textarea>
      <input type="submit" value="Post speichern!" class="btn btn-primary" />
    </div>
  </div>

</form>

<?php require(__DIR__ . "/../../layout/footer.php"); ?>