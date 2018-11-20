<?php
require_once 'init.php';
$information = findUserById($_GET['id']); 
$friends = getFriends($currentUser['id']); 
$friends1 = userFriends($currentUser['id']);
$isFriend1 = false;
$isFriend = false;
foreach ($friends AS $friend) {
  if ($friend['id'] == $information['id']) 
  {
    $isFriend = true;
  }
}
foreach ($friends1 AS $friend1) {
  if ($friend1['id'] == $information['id'])
  {
    $isFriend1 = true;
  }
}
$isFollow = isFollow($currentUser['id'], $information['id']); 
$isRequest = isFollow($information['id'], $currentUser['id']); 
?>
<?php include 'header.php' ?>
<h1>Tường nhà <?php echo $information['fullName'] ?></h1>
<img style = "width: 250px; height: 250px;" src="avatars/<?php echo $information['id'] ?>.jpg">
<?php if ($isFriend) : ?>
<form action="friend-request.php" method="POST">
  <input type="hidden" name="action" value="unfriend">
  <input type="hidden" name="informationId" value="<?php echo $information['id'] ?>">
  <button type="submit" class="btn btn-danger">Hủy kết bạn</button>
</form>
<?php else : ?>
  <?php if ($isFollow) : ?>
    <form action="friend-request.php" method="POST">
      <input type="hidden" name="action" value="cancel-friend-request">
      <input type="hidden" name="informationId" value="<?php echo $information['id'] ?>">
      <button type="submit" class="btn btn-primary">Hủy yêu cầu kết bạn</button>
    </form>
  <?php elseif ($isRequest and $isFriend1) : ?>
    <form action="friend-request.php" method="POST">
      <input type="hidden" name="action" value="accept-friend-request">
      <input type="hidden" name="informationId" value="<?php echo $information['id'] ?>">
      <button type="submit" class="btn btn-primary">Chấp nhận yêu cầu kết bạn</button>
    </form>
    <form action="friend-request.php" method="POST">
      <input type="hidden" name="action" value="reject-friend-request">
      <input type="hidden" name="informationId" value="<?php echo $information['id'] ?>">
      <button type="submit" class="btn btn-warning">Từ chối yêu cầu kết bạn</button>
    </form>
  <?php elseif($currentUser['id']) : ?>
    <form action="friend-request.php" method="POST">
      <input type="hidden" name="action" value="send-friend-request">
      <input type="hidden" name="informationId" value="<?php echo $information['id'] ?>">
      <button type="submit" class="btn btn-primary">Gửi yêu cầu kết bạn</button>
    </form>
  <?php endif; ?>
<?php endif; ?>
<?php include 'footer.php' ?>