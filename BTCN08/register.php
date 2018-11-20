<?php ob_start(); ?>
<?php
    require_once 'init.php';
    require_once 'functions.php';
    include 'header.php';
    $success = false;
    if(isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['password']))
    {
      $password = $_POST['password'];
      $fullName = $_POST['fullName'];
      $email = $_POST['email'];
      $passwordHash = password_hash($password,PASSWORD_DEFAULT);
      $userId = createUser($email,$fullName,$passwordHash);
      $_SESSION ['userId'] = $user['id'];
      header('Location: index.php');
      ob_enf_fluch();
      $success = true;
    }
?>
   <h2> <strong>ĐĂNG KÝ </strong></h2>
   <?php if(!$success) : ?>
  <form action="register.php" method="post">
  <div class="form-group">
    <label for="fullName">Tên người dùng</label>
    <input type="text" class="form-control" id="fullName" name ="fullName">
  </div>
  <div class="form-group">
    <label for="email">Địa chỉ Email</label>
    <input type="text" class="form-control" id="email" name = "email">
  </div>
  <div class="form-group">
    <label for="password">Mật khẩu</label>
    <input type="password" class="form-control" id="password" name = "password">
  </div>
  <button type="submit" class="btn btn-primary">Đăng ký</button>
</form>
<?php endif; ?>
</body>
</html>