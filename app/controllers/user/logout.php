<?php
session_unset();
session_destroy();

header('Location: /se265-capstone/login');
exit();
