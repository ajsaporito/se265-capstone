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

function getUser($id) {
  global $db;
  $result = [];

  $stmt = $db->prepare("SELECT * FROM Users WHERE id = :id");
  $stmt->bindValue(':id', $id);

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  return $result;
}

function userExists($username, $email) {
  global $db;

  $sql = $db->prepare("SELECT * FROM Users WHERE username = :u OR email = :e");
  $sql->bindValue(':u', $username);
  $sql->bindValue(':e', $email);

  if ($sql->execute() && $sql->rowCount() > 0) {
    $result = $sql->fetch(PDO::FETCH_ASSOC);
  }

  return $result;
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
      return ['success' => true, 'message' => 'Login successful'];
    } else {
      return ['success' => false, 'message' => 'Incorrect password'];
    }
  } else {
    return ['success' => false, 'message' => 'Username not found'];
  }
}

?>