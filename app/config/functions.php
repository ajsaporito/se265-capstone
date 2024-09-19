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

function renderStars($rating) {
  $fullStars = str_repeat('★', $rating);
  $emptyStars = str_repeat('☆', 5 - $rating);
  return '<span class="stars">' . $fullStars . $emptyStars . '</span>';
}

function generateStarRating($rating) {
  $fullStars = floor($rating); 
  $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0; 
  $emptyStars = 5 - ($fullStars + $halfStar);

  $starsHTML = '';

  for ($i = 0; $i < $fullStars; $i++) {
    $starsHTML .= '<span class="fa fa-star checked"></span>';
  }

  if ($halfStar) {
    $starsHTML .= '<span class="fa fa-star-half-alt checked"></span>';
  }

  for ($i = 0; $i < $emptyStars; $i++) {
    $starsHTML .= '<span class="fa fa-star"></span>';
  }

  return $starsHTML;
}
