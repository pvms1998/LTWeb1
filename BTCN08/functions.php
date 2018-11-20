<?php 
  function findUserById($id)
  {
    global $db;
    $stmt= $db->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
    $stmt->execute(array($id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  function findUserByEmail($email)
  {
    global $db;
    $stmt= $db->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }
  
  function findAllPosts()
  {
    global $db;
    $stmt = $db->prepare("SELECT posts.*,users.fullName,posts.createdAt FROM posts  left join users on posts.userId = users.id  ORDER BY createdAt DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
  }
  function createUser($email,$fullName,$passwordHash)
  {
    global $db;
    $stmt= $db->prepare("INSERT INTO users(email, fullName, password) VALUES (?,?,?)");
    $stmt->execute(array($email,$fullName,$passwordHash));
    return $db->lastInsertId();
  }
  function createPosts($content,$userId)
  {
    global $db;
    $stmt= $db->prepare("INSERT INTO posts(content, userId, createdAt) VALUES (?,?,CURRENT_TIMESTAMP())");
    $stmt->execute(array($content,$userId));
    return $db->lastInsertId();
  }
  function changePass($passwordHash,$id)
  {
    global $db;
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute (array($passwordHash,$id));
  }
  function updateUser($user) 
  {
      global $db;
      $stmt = $db->prepare("UPDATE users SET fullName = ?, phone = ? WHERE id = ?");
      $stmt->execute(array($user['fullName'], $user['phone'], $user['id']));
      return $user;
  }
  function resizeImage($filename, $max_width, $max_height,$crop= FALSE,$output)
    {
        list($orig_width, $orig_height) = getimagesize($filename);

        $width = $orig_width;
        $height = $orig_height;

    # taller
    if ($height > $max_height) 
    {
        $width = ($max_height / $height) * $width;
        $height = $max_height;
    }

     # wider
    if ($width > $max_width) 
    {
        $height = ($max_width / $width) * $height;
        $width = $max_width;
    }

    $image_p = imagecreatetruecolor($width, $height);

    $image = imagecreatefromjpeg($filename);
    
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

    imagejpeg($image_p,$output);
    }

  function userFriends($userId) 
  {
    global $db;
      $stmt = $db->prepare("SELECT * FROM friends WHERE userId1 = ? OR userId2 = ?");
    $stmt->execute(array($userId, $userId));
      $followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $friends = array();
      for ($i = 0; $i < count($followings); $i++) 
      {
        $row1 = $followings[$i];
        if ($userId == $row1['userId2'])
        {
          $userId2 = $row1['userId1'];
              $friends[] = findUserById($userId2);
        }
      }
      return $friends;
  }
  
  function getFriends($userId) 
  {
    global $db;
      $stmt = $db->prepare("SELECT * FROM friends WHERE userId1 = ? OR userId2 = ?");
    $stmt->execute(array($userId, $userId));
      $followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $friends = array();
      for ($i = 0; $i < count($followings); $i++) 
      {
        $row1 = $followings[$i];
        if ($userId == $row1['userId1'])
        {
            $userId2 = $row1['userId2'];
            for ($j = 0; $j < count($followings); $j++) 
            {
              $row2 = $followings[$j];
              if ($userId == $row2['userId2'] && $userId2 == $row2['userId1']) 
              {
                  $friends[] = findUserById($userId2);
              }
            }
        }
      }
      return $friends;
  }
  function isFollow($userId1, $userId2) 
  {
    global $db;
    $stmt = $db->prepare("SELECT * FROM friends WHERE userId1 = ? AND userId2 = ?");
      $stmt->execute(array($userId1, $userId2));
    $user1ToUser2 = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!$user1ToUser2) 
      {
        return false;
      }
   $stmt = $db->prepare("SELECT * FROM friends WHERE userId1 = ? AND userId2 = ?");
   $stmt->execute(array($userId2, $userId1));
   $user2ToUser1 = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($user2ToUser1) 
      {
        return false;
      }
      return true;
  } 

  function unfriend($userId1, $userId2) // hủy kết bạn
  {
    global $db;
    $stmt = $db->prepare("DELETE FROM friends WHERE userId1 = ? AND userId2 = ?");
     $stmt->execute(array($userId1, $userId2));
     $stmt = $db->prepare("DELETE FROM friends WHERE userId1 = ? AND userId2 = ?");
     $stmt->execute(array($userId2, $userId1));
  }

  function sendFriendRequest($userId1, $userId2) //gửi lời mời kết bạn
  {
     global $db;
     $stmt = $db->prepare("INSERT INTO friends(userId1, userId2) VALUES(?, ?)");
     $stmt->execute(array($userId1, $userId2));
  }

  function acceptFriendRequest($userId1, $userId2) // chấp nhận kết bạn
  {
      global $db;
      $stmt = $db->prepare("INSERT INTO friends(userId1, userId2) VALUES(?, ?)");
      $stmt->execute(array($userId1, $userId2));
  }

  function rejectFriendRequest($userId1, $userId2) // từ chối kết bạn
  {
      global $db;
      $stmt = $db->prepare("DELETE FROM friends WHERE userId1 = ? AND userId2 = ?");
     $stmt->execute(array($userId2, $userId1));
  }

  function cancelFriendRequest($userId1, $userId2) // hủy yêu cầu kết bạn
  {
      global $db;
      $stmt = $db->prepare("DELETE FROM friends WHERE userId1 = ? AND userId2 = ?");
      $stmt->execute(array($userId1, $userId2));
  }


  