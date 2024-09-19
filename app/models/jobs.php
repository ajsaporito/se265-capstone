<?php

function getAllJobs(){
  global $db;
  $result = [];

  $sql = $db->prepare("SELECT * FROM Jobs");

  if ($sql->execute() && $sql->rowCount() > 0) {
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  return $result;
}

function getAllOpenJobs() {
  global $db;

  $stmt = $db->prepare("
    SELECT Jobs.*, Users.first_name, Users.last_name 
    FROM Jobs 
    JOIN Users ON Jobs.posted_by = Users.user_id
    WHERE Jobs.status = 'open'
    ORDER BY Jobs.date_posted DESC
  ");
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJobsByStatus($user_id, $status) {
  global $db;

  $stmt = $db->prepare("
    SELECT Jobs.*, Users.first_name, Users.last_name 
    FROM Jobs 
    LEFT JOIN Users ON Jobs.contractor_id = Users.user_id 
    WHERE Jobs.posted_by = :user_id AND Jobs.status = :status 
    ORDER BY Jobs.date_posted DESC
  ");

  $stmt->execute([':user_id' => $user_id, ':status' => $status]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJobById($job_id) {
  global $db;

  $stmt = $db->prepare("SELECT * FROM Jobs WHERE job_id = :id");
  $stmt->bindValue(':id', $job_id, PDO::PARAM_INT);
  $stmt->execute();
  $job = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($job) {
    $stmt = $db->prepare("SELECT Skills.skill_name FROM JobSkills
                          JOIN Skills ON JobSkills.skill_id = Skills.skill_id
                          WHERE JobSkills.job_id = :job_id");

    $stmt->bindValue(':job_id', $job_id, PDO::PARAM_INT);
    $stmt->execute();
    $job['skills'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  return $job;
}

function saveJobWithSkills($jobData, $skills) {
  global $db;

  try {
    $db->beginTransaction();

    // Insert the job into the Jobs table
    $stmt = $db->prepare("INSERT INTO Jobs (posted_by, title, location, description, budget, status, job_type, hourly_rate, estimated_hours_per_week, estimated_completion_date)
                          VALUES (:posted_by, :title, :location, :description, :budget, :status, :job_type, :hourly_rate, :estimated_hours_per_week, :estimated_completion_date)");
    $stmt->execute($jobData);
    $jobId = $db->lastInsertId();

    // Insert each skill into the JobSkills table
    foreach ($skills as $skill_id) {
      $stmt = $db->prepare("INSERT INTO JobSkills (job_id, skill_id) VALUES (:job_id, :skill_id)");
      $stmt->execute([':job_id' => $jobId, ':skill_id' => $skill_id]);
    }

    $db->commit();
  } catch (Exception $e) {
    $db->rollBack();
    throw $e;
  }
}

function getAllSkills() {
  global $db;

  $stmt = $db->prepare("SELECT DISTINCT skill_name, skill_id FROM Skills ORDER BY skill_name ASC");
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function hasUserRequestedJob($user_id, $job_id) {
  global $db;

  $stmt = $db->prepare("SELECT * FROM Requests WHERE requested_by = :user_id AND job_id = :job_id");
  $stmt->execute([':user_id' => $user_id, ':job_id' => $job_id]);

  return $stmt->rowCount() > 0;
}

function addJobRequest($job_id, $user_id) {
  global $db;
  $stmt = $db->prepare("INSERT INTO Requests (job_id, requested_by, status) VALUES (:job_id, :user_id, 'pending')");

  return $stmt->execute([':job_id' => $job_id, ':user_id' => $user_id]);
}

function getJobRequestsByJobId($job_id) {
  global $db;

  $stmt = $db->prepare("
    SELECT Requests.*, Users.first_name, Users.last_name 
    FROM Requests 
    JOIN Users ON Requests.requested_by = Users.user_id 
    WHERE Requests.job_id = :job_id
  ");

  $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJobByIdWithContractor($job_id) {
  global $db;

  $stmt = $db->prepare("
    SELECT Jobs.*, Users.first_name AS contractor_first_name, Users.last_name AS contractor_last_name 
    FROM Jobs 
    JOIN Users ON Jobs.contractor_id = Users.user_id 
    WHERE Jobs.job_id = :job_id
  ");

  $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function acceptJobRequest($job_id, $requested_by) {
  try {
    global $db;
    $db->beginTransaction();

    $stmt = $db->prepare("SELECT COUNT(*) FROM Users WHERE user_id = :requested_by");
    $stmt->execute([':requested_by' => $requested_by]);

    if ($stmt->fetchColumn() == 0) {
      throw new Exception("User with id $requested_by does not exist.");
    }

    $stmt = $db->prepare("UPDATE Jobs SET contractor_id = :requested_by, status = 'in-progress' WHERE job_id = :job_id");
    $stmt->execute([':requested_by' => $requested_by, ':job_id' => $job_id]);

    $stmt = $db->prepare("UPDATE Requests SET status = 'accepted' WHERE job_id = :job_id AND requested_by = :requested_by");
    $stmt->execute([':job_id' => $job_id, ':requested_by' => $requested_by]);

    $db->commit();
    return true;

  } catch (Exception $e) {
    $db->rollBack();
    error_log($e->getMessage());
    throw $e;
  }
}

function searchJobs($search) {
  global $db;

  $binds = array();
  $sql = "SELECT * FROM Jobs WHERE status = 'open'";

  if ($search != "") {
    $sql .= " AND title LIKE :title";
    $binds['title'] = $search.'%';
  }

  $result = array();
  $stmt = $db->prepare($sql);

  if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  return $result; 
}

function getJobRequestsByClient($client_id) {
  global $db;
  $stmt = $db->prepare("SELECT * FROM Requests JOIN Jobs ON Requests.job_id = Jobs.job_id WHERE Jobs.posted_by = :client_id");
  $stmt->execute([':client_id' => $client_id]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function markJobAsCompleted($job_id) {
  global $db;

  try {
    $db->beginTransaction();
    $stmt = $db->prepare("UPDATE Jobs SET status = 'complete' WHERE job_id = :job_id");
    $stmt->execute([':job_id' => $job_id]);
    $db->commit();

    echo json_encode(['status' => 'success']);
  } catch (Exception $e) {
    $db->rollBack();

    error_log("Failed to mark job as completed: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
  }
}

function updateJobStatus($job_id, $status) {
  global $db;

  $stmt = $db->prepare("UPDATE Jobs SET status = :status WHERE job_id = :job_id");

  return $stmt->execute([':status' => $status, ':job_id' => $job_id]);
}

function deleteJobById($job_id) {
  global $db;

  $stmt = $db->prepare("DELETE FROM Jobs WHERE job_id = :job_id");
  $stmt->bindValue(':job_id', $job_id, PDO::PARAM_INT);

  return $stmt->execute();
}

function deleteOpenJob($job_id) {
  global $db;

  try {
    $stmt = $db->prepare("DELETE FROM Jobs WHERE job_id = :job_id AND status = 'open'");
    $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      echo json_encode(['status' => 'success']);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Failed to delete job.']);
    }
  } catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  }
}
