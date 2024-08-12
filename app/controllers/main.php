<?php

function renderDashboard() {
  if (!isset($_SESSION['user'])) {
    header('Location: /se265-capstone/login');
  }

  require VIEW_PATH . 'main/dashboard.php';
}

function renderJobs() {
  if (!isset($_SESSION['user'])) {
    header('Location: /se265-capstone/login');
  }

  require VIEW_PATH . 'main/jobs.php';
}

function renderPeople() {
  if (!isset($_SESSION['user'])) {
    header('Location: /se265-capstone/login');
  }

  require VIEW_PATH . 'main/people.php';
}

function renderSearch() {
  if (!isset($_SESSION['user'])) {
    header('Location: /se265-capstone/login');
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
