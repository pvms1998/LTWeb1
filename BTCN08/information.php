<?php ob_start(); ?>
<?php
require_once 'init.php';

$fullname = $currentUser['fullName'];
$phone = $currentUser['phone'];
$success = true;

// Kiểm tra người dùng có nhập tên
if (isset($_POST['fullname']) && is_numeric($_POST['phone'])) 
{
  if (strlen($_POST['fullname']) > 0) 
  {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $currentUser['fullName'] = $fullname;
    $currentUser['phone'] = $phone;
    updateUser($currentUser);
    $success = false;
  } 
 
  // xử lý file
  if(isset($_FILES['avatar'])) 
  {
    $fileTemp = $_FILES['avatar']['tmp_name'];
    $fileName = 'avatars/' . $currentUser['id'] . '.jpg';

    $result = move_uploaded_file($fileTemp,$fileName); // lưu ảnh vào thư mục
    if ($result) 
    {
      resizeImage($fileName, 256, 256,false,$fileName);
    }
    $success = false;
  }
    header('Location: information.php');
    ob_enf_fluch();
}

?>
<?php include 'header.php' ?>
<h1>Quản lý thông tin cá nhân</h1>
<?php if (!$success) : ?>
<div class="alert alert-danger" role="alert">
  Vui lòng nhập đầy đủ thông tin!
</div>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="fullname">Họ và tên</label>
    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập Họ và tên" value="<?php echo $fullname ?>">
  </div>
  <div class="form-group">
    <label for="phone">Số điện thoại</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="<?php echo $phone ?>">
  </div>
  <div class="form-group">
    <label for="avatar">Hình ảnh đại diện</label>
    <input type="file" class="form-control-file" id="avatar" name="avatar">
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
<?php include 'footer.php' ?>