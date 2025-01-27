<?php

function renderAdmin() {
  include MODEL_PATH . 'users.php';

  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  if (!isAdmin($_SESSION['user_id'])) {
    header('Location: /se265-capstone');
    exit();
  }

  $users = getAllUsers();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteBtn'])) {
      $user_id = (int) $_POST['user_id'];
      deleteUser($user_id);
      header('Location: /se265-capstone/admin');
    }
  }

  require VIEW_PATH . 'admin/admin-dash.php';
}
