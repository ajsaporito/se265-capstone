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

  $sql = $db->prepare("SELECT * FROM Users WHERE id = :id");
  $sql->bindValue(':id', $id);

  if ($sql->execute() && $sql->rowCount() > 0) {
    $result = $sql->fetch(PDO::FETCH_ASSOC);
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

function signUp($username, $email, $password) {
  global $db;

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $db->prepare("INSERT INTO Users (username, email, password) VALUES (:u, :e, :p)");
  $stmt->bindValue(':u', $username);
  $stmt->bindValue(':e', $email);
  $stmt->bindValue(':p', $hashedPassword);

  return $stmt->execute();
}

function logIn($username, $email, $password) {
  global $db;
  $result = [];

  $stmt = $db->prepare("SELECT * FROM Users WHERE username = :u AND email = :e AND password = :p");
  $stmt->bindValue(':u', $username);
  $stmt->bindValue(':e', $email);
  $stmt->bindValue(':p', $password);

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  return $result;
}
