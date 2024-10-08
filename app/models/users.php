<?php

include CONFIG_PATH . 'db.php';

function getAllUsers() {
  global $db;
  $result = [];

  $sql = $db->prepare("SELECT * FROM Users");

  if ($sql->execute() && $sql->rowCount() > 0 ) {
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  return $result;
}

function getUserId($username) {
  global $db;
  $result = [];

  $stmt = $db->prepare("SELECT user_id FROM Users WHERE username = :u");
  $stmt->bindValue(':u', $username);

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['user_id'];
  }

  return null;
}

function getUserById($id) {
  global $db;
  $result = [];

  $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
  $stmt->bindValue(':id', $id);

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  return $result;
}

function getUserRecord($id) {
  global $db;
  $result = [];

  $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
  $stmt->bindValue(':id', $id);

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  return $result;
}

function userExistsById($id) {
  global $db;

  $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
  $stmt->bindValue(':id', $id);

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    return true;
  }
  return false;
}

function userExistsByUsername($username) {
  global $db;

  $sql = $db->prepare("SELECT * FROM Users WHERE username = :u");
  $sql->bindValue(':u', $username);

  if ($sql->execute() && $sql->rowCount() > 0) {
    return ['success' => false, 'message' => 'Username is already taken'];
  }

  return ['success' => true, 'message' => ''];
}

function userExistsByEmail($email) {
  global $db;

  $sql = $db->prepare("SELECT * FROM Users WHERE email = :e");
  $sql->bindValue(':e', $email);

  if ($sql->execute() && $sql->rowCount() > 0) {
    return ['success' => false, 'message' => 'Email is already taken'];
  }

  return ['success' => true, 'message' => ''];
}

function signUp($firstName, $lastName, $username, $email, $password) {
  global $db;
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $db->prepare("INSERT INTO Users (first_name, last_name, username, email, password) VALUES (:f, :l, :u, :e, :p)");
  $stmt->bindValue(':f', $firstName);
  $stmt->bindValue(':l', $lastName);
  $stmt->bindValue(':u', $username);
  $stmt->bindValue(':e', $email);
  $stmt->bindValue(':p', $hashedPassword);

  return $stmt->execute();
}

function logIn($username, $password) {
  global $db;

  $stmt = $db->prepare("SELECT user_id, username, password FROM Users WHERE username = :u LIMIT 1");
  $stmt->bindValue(':u', $username);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    if (password_verify($password, $user['password'])) {  
      return ['success' => true, 'message' => ''];
    } else {
      return ['success' => false, 'message' => 'Incorrect password'];
    }
  } else {
    return ['success' => false, 'message' => 'Username not found'];
  }
}

function updateProfile($id, $firstName, $lastName, $username, $email) {
  global $db;

  $stmt = $db->prepare("UPDATE Users SET first_name = :f, last_name = :l, username = :u, email = :e WHERE user_id = :id");
  $stmt->bindValue(':f', $firstName);
  $stmt->bindValue(':l', $lastName);
  $stmt->bindValue(':u', $username);
  $stmt->bindValue(':e', $email);
  $stmt->bindValue(':id', $id);

  return $stmt->execute();
}

function userExistsByUsernameEdit($username, $currentId) {
  global $db;

  $sql = $db->prepare("SELECT * FROM Users WHERE username = :u AND user_id != :id");
  $sql->bindValue(':u', $username);
  $sql->bindValue(':id', $currentId);

  if ($sql->execute() && $sql->rowCount() > 0) {
    return ['success' => false, 'message' => 'Username is already taken'];
  }

  return ['success' => true, 'message' => ''];
}

function userExistsByEmailEdit($email, $currentId) {
  global $db;

  $sql = $db->prepare("SELECT * FROM Users WHERE email = :e AND user_id != :id");
  $sql->bindValue(':e', $email);
  $sql->bindValue(':id', $currentId);

  if ($sql->execute() && $sql->rowCount() > 0) {
    return ['success' => false, 'message' => 'Email is already taken'];
  }

  return ['success' => true, 'message' => ''];
}

function changePassword($id, $newPassword) {
  global $db;
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

  $stmt = $db->prepare("UPDATE Users SET password = :p WHERE user_id = :id");
  $stmt->bindValue(':p', $hashedPassword);
  $stmt->bindValue(':id', $id);

  return $stmt->execute();
}


function searchPeople($search) {
  global $db;

  $binds = array();
  $sql = "SELECT * FROM Users WHERE 0 = 0";

  if ($search != "") {
    $sql .= " AND username LIKE :username";
    $binds['username'] = $search.'%';
  }

  $result = array();
  $stmt = $db->prepare($sql);

  if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  return $result; 
}



/* NEW 8/15 for user-profile review section */ 
function getCompletedJobsByUserId($user_id) {
  global $db;

  $stmt = $db->prepare("
      SELECT *
      FROM Jobs
      WHERE contractor_id = :user_id
      AND status = 'complete'
  ");
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

