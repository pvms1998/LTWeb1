<!DOCTYPE html>
<html lang="en">
<head>
  <title>HEADER</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body style=" width: 90%; border-collapse: collapse; margin-right: 5%; margin-left:  5%;">
  <?php require_once 'init.php';
        require_once 'functions.php';
        $invites = userFriends($currentUser['id']);
        $friends = getFriends($currentUser['id']);
        $invite1 = 0;
        $friend1 = 0;
  ?>

  <?php foreach ($invites as $invite) : ?> 
    <?php if($isRequest = isFollow($invite['id'], $currentUser['id'])):  ?>
    <?php $invite1 = $invite1 + 1 ?>
  <?php endif; ?>
  <?php endforeach; ?>

  <?php foreach ($friends as $friend) : ?>
    <?php $friend1 = $friend1 + 1; ?>
  <?php endforeach; ?>

<nav class="navbar navbar-expand-md bg-white navbar-black">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href=""><strong>BTCN07</strong></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Trang chủ</a>
      </li>
       <?php if(!$currentUser): ?>
      <li class="nav-item ">
        <a class="nav-link" href="register.php">Đăng ký</a>
      </li> 
      <li class="nav-item ">  
        <a class="nav-link" href="login.php">Đăng nhập</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Đăng xuất</a>
      </li> 
       <li class="nav-item">
        <a class="nav-link" href="information.php"><?php echo $currentUser['fullName']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="invite.php">Lời mời kết bạn ( <?php echo $invite1 ?> )</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="friend.php">Bạn bè ( <?php echo $friend1 ?> )</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newstatus.php">Đăng trạng thái</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="changepassword.php">Đổi mật khẩu</a>
      </li> 
    <?php endif; ?>
    </ul>
  </div> 
</nav>
</body>
</html>