<?php

function debug($data) {
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}

// Destroy login session after 15 minutes of no page refresh
function checkInactivity() {
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
