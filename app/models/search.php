<?php

include CONFIG_PATH . 'db.php';

function navSearch($search) {
  global $db;
  $result = [];
  $search = '%' . $search . '%';

  $userSql = $db->prepare("SELECT 'user' AS type, id, first_name AS firstName, last_name AS lastName, NULL AS job_title, NULL AS skills FROM Users WHERE first_name LIKE :search OR last_name LIKE :search");
  $userSql->bindValue(':search', $search);

  $jobSql = $db->prepare("SELECT 'job' AS type, id, job_title, skills FROM Jobs WHERE job_title LIKE :search OR skills LIKE :search");
  $jobSql->bindValue(':search', $search);

  if ($userSql->execute() && $jobSql->execute()) {
    $userResults = $userSql->fetchAll(PDO::FETCH_ASSOC);
    $jobResults = $jobSql->fetchAll(PDO::FETCH_ASSOC);
    $result = array_merge($userResults, $jobResults);
  }

  return $result;
}
