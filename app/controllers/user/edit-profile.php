<?php

include MODEL_PATH . 'users.php';

/*if (!isset($_SESSION['user'])) {
  header('Location: /se265-capstone/login');
  exit();
} */

require VIEW_PATH . 'user/edit-profile.php';
