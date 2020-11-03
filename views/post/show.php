<?php include __DIR__ . "/../layout/header.php" ?>


<h1></h1>
<div class="jumbotron">
  <div class="container">
    <h3 class="panel-title"><?php echo e($post["title"]); ?></h3>
  </div>
  <hr>
  <div class="container">
    <?php echo nl2br(e($post["content"]))  ?>
  </div>
<br>
<hr>
<br>
  <div class="container">
    <h3 class="panel-title"> Comments </h3>
  </div>
  <div class="container">
    <ul class="">
      <?php foreach ($comments as $comment) : ?>
        <li class="">
          <?php echo (e ($comment->content)) ?>
        </li>
      <?php endforeach ?>
    </ul>
    <form method="post" action="post?id=<?php echo e($post['id']) ?>">
    <textarea name="content" class="form-control"></textarea>
    <br>
    <input type="submit" value="Kommentar hinzufügen" class="btn btn-primary">
    </form>
  </div>

  
</div>

<?php include __DIR__ . "/../layout/footer.php" ?>