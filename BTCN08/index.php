<?php
    require_once 'init.php';
    require_once 'functions.php';
    $page = 'index';
    $posts = findAllPosts();
?>
<?php include 'header.php'; ?>
<h2><strong>TRANG CHỦ  </strong></h2>
<p>
<?php if ($currentUser) : ?>
  Xin chào <?php echo $currentUser['fullName']; ?>. Chào mừng bạn đã trở lại.
<?php else: ?>
  Chào mừng đến với mạng xã hội 16CK2...
<?php endif; ?>
</p>
<?php foreach ($posts as $post) : ?>
<div class="card" >
  <div class="card-body">
    <?php if($currentUser['id'] == $post['userId'] ): ?>
      <a href="information.php">
      <img style = "width: 80px; height: 80px;" src=".\avatars\<?php echo $post['userId'] ?>.jpg"> </a>
    <?php else: ?>
      <a href="wall.php?id=<?php echo $post['userId']; ?>">
      <img style = "width: 80px; height: 80px;" src=".\avatars\<?php echo $post['userId'] ?>.jpg"> </a>
   <?php endif; ?>
    <h5 class="card-title"><?php echo $post['fullName']; ?></h5>
    <p class="card-text"><?php echo $post['content']; ?></p>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post['createdAt']; ?></h6>
  </div>
</div>
<?php endforeach; ?>
<?php include 'footer.php'; ?>