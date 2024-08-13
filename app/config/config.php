<?php

define('BASE_PATH', __DIR__ . '/../');
define('CONFIG_PATH', BASE_PATH . 'config/');
define('MODEL_PATH', BASE_PATH . 'models/');
define('VIEW_PATH', BASE_PATH . 'views/');
define('PARTIAL_PATH', VIEW_PATH . 'partials/');

require_once CONFIG_PATH . 'db.php';

function checkInactivity() {
  // Destroy login session after 15 minutes of inactivity
  if (isset($_SESSION['last_activity']) &&
    (time() - $_SESSION['last_activity']) > 900 &&
    (isset($_SESSION['user_id']))) {
    session_unset();
    session_destroy(); ?>
    <script>
      window.location.href = '/se265-capstone/login';
      alert('You have been logged out due to inactivity');
    </script>
    <?php
    exit();
  } else {
    $_SESSION['last_activity'] = time();
  }
}
