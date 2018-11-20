<?php ob_start(); ?>
<?php 
require_once 'init.php';
$action = $_POST['action'];
$informationId = $_POST['informationId'];

if ($action == 'unfriend') {
  unfriend($currentUser['id'], $informationId);
}
if ($action == 'send-friend-request') {
  sendFriendRequest($currentUser['id'], $informationId);
}
if ($action == 'accept-friend-request') {
  acceptFriendRequest($currentUser['id'], $informationId);
}
if ($action == 'reject-friend-request') {
  rejectFriendRequest($currentUser['id'], $informationId);
}
if ($action == 'cancel-friend-request') {
  cancelFriendRequest($currentUser['id'], $informationId);
}
header('Location: wall.php?id=' . $informationId);
ob_enf_fluch();
?>