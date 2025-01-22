<?php

function renderAdmin() {
  include MODEL_PATH . 'users.php';

  /*if (!isset($_SESSION['user_id']) || !isAdmin($user_id)) {
    header('Location: /se265-capstone/login');
    exit();
  }*/

  require VIEW_PATH . 'admin/admin-dash.php';
}

function renderAdminJobs() {
  include MODEL_PATH . 'users.php';
  include MODEL_PATH . 'jobs.php';

  /*if (!isset($_SESSION['user_id']) || !isAdmin($user_id)) {
    header('Location: /se265-capstone/login');
    exit();
  }*/

  // TODO: Add logic to get all job records with delete functionality

  require VIEW_PATH . 'admin/admin-jobs.php';
}

function renderAdminUsers() {
  include MODEL_PATH . 'users.php';

  /*if (!isset($_SESSION['user_id']) || !isAdmin($user_id)) {
    header('Location: /se265-capstone/login');
    exit();
  }*/

  // TODO: Add logic to get all user records with delete functionality

  require VIEW_PATH . 'admin/admin-users.php';
}
