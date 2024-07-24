<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
  header('Location: /se265-capstone');
}

session_unset(); 
session_destroy();

$redirect = false;

if (!headers_sent()) {
  header('Location: /se265-capstone');
}

if (!$redirect): ?>
<div style="text-align: center; padding-top: 48px;">
  <p>You were logged out...</p>
  <p>If you weren't redirected automatically, click
    <a href="/se265-capstone">here</a> to return to the site.
  </p>
</div>
<?php endif; ?>
