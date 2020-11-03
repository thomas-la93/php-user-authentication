<?php require(__DIR__ . "/../../layout/header.php"); ?>

<br /> <br />


<div class="container">
  <h3>Post editieren</h3>
  <a href="posts-admin">back</a>

  <?php if(!empty($savedSuccess)): ?>
    <p>Der Post wurde erfolgreich gespeichert.</p>
  <?php endif; ?>
  <?php if(!empty($savedSuccessCreate)): ?>
    <p>Der Post wurde erfolgreich erstellt und kann jetzt editiert werden.</p>
  <?php endif; ?>
</div>

<form method="POST" name="TEST"action="posts-edit?id=<?php echo e($post->id); ?>" class="">
  <div class="form-group">
    <label class="control-label col-md-3">
      Titel:
    </label>
    <div class="col-md-9">
      <input type="text" name="title" value="<?php echo e($post->title); ?>" class="form-control" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3">
      Inhalt:
    </label>
    <div class="col-md-9">
      <textarea name="content" class="form-control" rows="10"><?php echo e($post->content); ?></textarea>
      <input type="submit" value="Post speichern!" class="btn btn-primary" />
      <a class="btn btn-danger" data-method="DELETE" href="posts-delete?id=<?php echo e($post->id); ?>">DELETE</a>
    </div>
  </div>
</form>

<?php require(__DIR__ . "/../../layout/footer.php"); ?>