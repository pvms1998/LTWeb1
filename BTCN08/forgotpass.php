<?php include 'header.php'; ?>
  <?php
    require_once 'init.php';
    require_once 'functions.php';
    $success = false;
    if(isset($_POST['email']))
    {
       $email = $_POST['email'];
       if($email == $user)
       {
        echo 'Đã gửi hướng dẫn đến mail';
        $success = true;
        exit;
       }
    }
  ?>
<h2> <strong>QUÊN MẬT KHẨU </strong></h2>
<?php if(!$success): ?>
  <form action="login.php" method="post">
  <div class="form-group">
    <label for="email">Nhập Email</label>
    <input type="email" class="form-control" id="email" name = "email">
  </div>
  <button type="submit" class="btn btn-primary">Gửi</button>
</form>
<?php endif; ?>
<?php include 'footer.php' ?>