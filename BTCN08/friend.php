<?php
require_once 'init.php';
$friends = getFriends($currentUser['id']);
?>
<?php include 'header.php' ?>
<h1>Danh sách bạn bè</h1>
<ul type="none">
  <?php foreach ($friends as $friend) : ?>
  <li>
  	<a  href="wall.php?id=<?php echo $friend['id']; ?>">
  	<img style = "width: 90px; height: 90px;" src=".\avatars\<?php echo $friend['id'] ?>.jpg">
     </a>
     <?php echo $friend['fullName'] ?> 
  </li>
</br>
  <?php endforeach; ?>
</ul>
<?php include 'footer.php' ?>