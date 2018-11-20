<?php ob_start(); ?>
<?php include 'header.php'; ?>
  <?php
    require_once 'init.php';
    require_once 'functions.php';
    $page = 'login';
    $success = false;
    if(isset($_POST['email']) && isset($_POST['password']))
    {
      $password = $_POST['password'];
       $email = $_POST['email'];
      $user = findUserByEmail($email);
      if($user)
      {
        $check = password_verify($password,$user['password']);
        if($check)
        {
          $_SESSION ['userId'] = $user['id'];
          header('Location: index.php');
          ob_enf_fluch();
          $success = true;
        }
         else
          printf('Mật khẩu không đúng');
      }
      else
      {
        printf('Email không hợp lệ');
      }
    }
  ?>
   <h2> <strong>ĐĂNG NHẬP </strong></h2>
<?php if(!$success) : ?>
  <form action="login.php" method="post">
  <div class="form-group">
    <label for="email">Địa chỉ Email</label>
    <input type="email" class="form-control" id="email" name = "email">
  </div>
  <div class="form-group">
    <label for="password">Mật khẩu</label>
    <input type="password" class="form-control" id="password" name = "password">
  </div>
  <button type="submit" class="btn btn-primary">Đăng nhập</button>
</form>
<?php endif; ?>
<?php include 'footer.php' ?>