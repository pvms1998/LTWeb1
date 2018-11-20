<?php
    require_once 'init.php';
    include 'header.php';
    require_once 'functions.php';
    $success = false;
    $dem = 1;
    $dem1 = 1;
    if(isset($_POST['password1']))
    {
      $password = $_POST['password1'];
      $email = $user['email'];
      $user = findUserByEmail($email);
      if($user)
      {
        $check = password_verify($password,$user['password']);
        if($check)
        {
          $_SESSION ['userId'] = $user['id'];
          $dem = 2;
        }
        else
        {
          echo  'Mật khẩu cũ không đúng.';
          $dem = 3;
        }
      }
    }
    if(isset($_POST['passwordnew']) && isset($_POST['passwordnew1']))
    {
      $passwordnew = $_POST['passwordnew'];
      $passwordnew1 = $_POST['passwordnew1'];
      if($passwordnew == NULL && $dem == 2)
      {
        echo 'Vui lòng nhập mật khẩu mới';
      }
      
      if($passwordnew != $passwordnew1 && $passwordnew != null)
      {
         echo 'Mật khẩu mới (nhập lại) không khớp.';
      }
      if($passwordnew == $passwordnew1 && $passwordnew != null)
      {
        $dem1 = 2;
      }
    }
    if($dem == 2 && $dem1 == 2 && isset($_POST['passwordnew']))
    {
      $passwordnew = $_POST['passwordnew'];
      $passwordHash  = password_hash( $passwordnew,PASSWORD_DEFAULT);
      $id = $currentUser['id'];
      changePass($passwordHash,$id);
      $success = true;
    }
?>
<h2> <strong>Đổi mật khẩu</strong></h2>
<?php if(!$success): ?>
  <form action="changepassword.php" method="post">
  <div class="form-group">
    <label for="password1">Mật khẩu cũ</label>
    <input type="password" class="form-control" id="password1" name = "password1">
  </div>
  <div class="form-group">
    <label for="passwordnew">Mật khẩu mới</label>
    <input type="password" class="form-control" id="passwordnew" name = "passwordnew">
  </div>
  <div class="form-group">
    <label for="passwordnew1">Mật khẩu mới(nhập lại)</label>
    <input type="password" class="form-control" id="passwordnew1" name = "passwordnew1">
  </div>
  <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
</form>
<?php endif; ?>
<?php if($success && $dem == 2 && $dem1 == 2): ?>
  Thay đổi thành công.
<?php endif; ?>
<?php include 'footer.php' ?>