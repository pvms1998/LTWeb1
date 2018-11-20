<?php ob_start(); ?> 
<?php
    require_once 'init.php';
    require_once 'functions.php';
    $page = 'newstatus';
    $success = true;
    if(isset($_POST['content']))
    {
      $content = $_POST['content'];
      if(strlen($content) == 0 || strlen($content) > 1024)
      {
        $success = false;
      }
      else
      {
        $content = $_POST['content'];
        $userId = $currentUser['id'];
        createPosts($content,$userId);
        header('Location: index.php');
        ob_enf_fluch();
      } 
  }
?>
  <?php include 'header.php'; ?>
  <h2>Thêm trạng thái mới</h2>
  <?php if (!$success) : ?>
<div class="alert alert-danger" role="alert">
  Nội dung không được rỗng và dài quá 1024 ký tự!
</div>
<?php endif; ?>
  <form action="newstatus.php" method="post">
    <div class="form-group">
      <input type="text" class="form-control form-control-sm" placeholder="Bạn đang nghĩ gì?" id="content" name="content">
    </div>
    <button type="submit" class="btn btn-primary">Đăng</button>
  </form>
</div>
<?php include 'footer.php'; ?>