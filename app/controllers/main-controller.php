<?php

function renderDashboard() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }

  require VIEW_PATH . 'main/dashboard.php';
}

function renderSearch() {
  if (!isset($_SESSION['user_id'])) {
    header('Location: /se265-capstone/login');
    exit();
  }
  
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
    echo $search;
  }
}

function renderAbout() {
  require VIEW_PATH . 'static/about.php';
}

function renderContact() {
  require VIEW_PATH . 'static/contact.php';
}
