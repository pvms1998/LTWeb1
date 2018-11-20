<?php
require_once 'init.php';
$invites = userFriends($currentUser['id']);
?>
<?php include 'header.php' ?>
<ul type="none">
     <?php foreach ($invites as $invite) : ?> 
    <?php if($isRequest = isFollow($invite['id'], $currentUser['id'])):  ?>
  <li>
    <a  href="wall.php?id=<?php echo $invite['id']; ?>">
    <img style = "width: 100px; height: 100px;" src=".\avatars\<?php echo $invite['id'] ?>.jpg">
     </a>
     <?php echo $invite['fullName'] ?> 
     </br>
     <form action="friend-request.php" method="POST">
      <input type="hidden" name="action" value="accept-friend-request">
      <input type="hidden" name="informationId" value="<?php echo $invite['id'] ?>">
      <button type="submit" class="btn btn-primary">Chấp nhận yêu cầu kết bạn</button>
    </form>
    <form action="friend-request.php" method="POST">
      <input type="hidden" name="action" value="reject-friend-request">
      <input type="hidden" name="informationId" value="<?php echo $invite['id'] ?>">
      <button type="submit" class="btn btn-warning">Từ chối yêu cầu kết bạn</button>
    </form>
  </li>
  <?php endif; ?>
</br>
  <?php endforeach; ?>
</ul>
<?php include 'footer.php' ?>