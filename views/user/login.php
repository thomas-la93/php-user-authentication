<?php include __DIR__ . "/../layout/header.php" ?>

<br>
<br>
<br>
<br>

<?php if (!empty($error)): ?>
  <p>
    Die Kombination aus Benutzername und Passwort ist falsch.
  </p>
<?php endif; ?>




<form action="login" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <!-- <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php include __DIR__ . "/../layout/footer.php" ?>



