<?php include __DIR__ . "/../layout/header.php" ?>

<h1>Dashboard</h1>

<h3> Hallo <?php echo e($username)?>!</h3>
<ul>
    <li><a href="posts-admin">Edit your Posts</a></li>
    <li><a href="posts-new">New Post</a></li>
    <li><a href="logout">Logout</a></li>
</ul>



<?php include __DIR__ . "/../layout/footer.php" ?>