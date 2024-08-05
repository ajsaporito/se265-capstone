<?php

function renderLogin() {
  require VIEW_PATH . 'user/login.php';
}

function renderSignUp() {
  require VIEW_PATH . 'user/signup.php';
}

function renderLogout() {
  session_unset();
  session_destroy();
  header('Location: /se265-capstone/login');
}

function renderEditProfile() {
  require VIEW_PATH . 'user/edit-profile.php';
}

function renderVerifyEmail() {
  require VIEW_PATH . 'user/verify-email.php';
}