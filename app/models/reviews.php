<?php 

include CONFIG_PATH . 'db.php';

function getJobId($id) {
  global $db;

  $sql = $db->prepare("SELECT job_id FROM Jobs WHERE posted_by = :id");
  $sql->bindValue(':id', $id, PDO::PARAM_INT);
  $sql->execute();

  $result = $sql->fetchAll(PDO::FETCH_COLUMN, 0);

  return $result;
}

function getAllReviewsJobIds() {
  global $db;

  $result = [];
  $sql = $db->prepare("SELECT job_id FROM Reviews");

  if ($sql->execute() && $sql->rowCount() > 0) {
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  return $result;
}

function getJobIdFromReviews() {
  global $db;

  $sql = $db->prepare("SELECT job_id FROM Reviews WHERE job_id IS NOT NULL");
  $sql->execute();

  $result = $sql->fetchAll(PDO::FETCH_COLUMN, 0);

  return $result;
}

// Function to get a review by ID for update and delete functionality
function GetReviewById($review_id) {
  global $db;

  $stmt = $db->prepare(
    'SELECT r.*, u.username AS reviewer_name, u2.username AS contractor_name 
    FROM Reviews r 
    JOIN Users u ON r.reviewer_id = u.user_id 
    JOIN Users u2 ON r.contractor_id = u2.user_id 
    WHERE r.review_id = :review_id'
  );

  $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to update a review
function UpdateReview($review_id, $communication, $time_management, $quality, $professionalism, $comments) {
  global $db;

  $stmt = $db->prepare(
    'UPDATE Reviews
    SET communication = :communication,
      time_management = :time_management,
      quality = :quality,
      professionalism = :professionalism,
      comments = :comments 
    WHERE review_id = :review_id');

  $stmt->bindParam(':communication', $communication, PDO::PARAM_INT);
  $stmt->bindParam(':time_management', $time_management, PDO::PARAM_INT);
  $stmt->bindParam(':quality', $quality, PDO::PARAM_INT);
  $stmt->bindParam(':professionalism', $professionalism, PDO::PARAM_INT);
  $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);
  $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);

  return $stmt->execute();
}

// Function to delete a review
function DeleteReview($review_id) {
  global $db;
    
  $stmt = $db->prepare('DELETE FROM Reviews WHERE review_id = :review_id');
  $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);

  return $stmt->execute();
}

function getReviewsByUserId($user_id) {
  global $db;

  $stmt = $db->prepare("
    SELECT Reviews.*, Users.first_name, Users.last_name
    FROM Reviews
    JOIN Users ON Reviews.reviewer_id = Users.user_id
    WHERE Reviews.contractor_id = :user_id
  ");
  $stmt->execute([':user_id' => $user_id]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAverageRatingsByUserId($user_id) {
  global $db;
  
  $stmt = $db->prepare("
    SELECT AVG(communication) AS avg_communication, 
          AVG(time_management) AS avg_time_management, 
          AVG(quality) AS avg_quality, 
          AVG(professionalism) AS avg_professionalism 
    FROM Reviews
    WHERE contractor_id = :user_id
  ");

  $stmt->execute([':user_id' => $user_id]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;
}

function addReview($reviewerId, $contractorId, $jobId, $communication, $time_management, $quality, $professionalism, $comments) {
  global $db;

  try {
    $db->beginTransaction();

    $stmt = $db->prepare(
      'INSERT INTO Reviews (reviewer_id, contractor_id, job_id, communication, time_management, quality, professionalism, comments) 
      VALUES (:reviewer_id, :contractor_id, :job_id, :communication, :time_management, :quality, :professionalism, :comments)'
    );

    $stmt->bindParam(':reviewer_id', $reviewerId, PDO::PARAM_INT);
    $stmt->bindParam(':contractor_id', $contractorId, PDO::PARAM_INT);
    $stmt->bindParam(':job_id', $jobId, PDO::PARAM_INT);
    $stmt->bindParam(':communication', $communication, PDO::PARAM_INT);
    $stmt->bindParam(':time_management', $time_management, PDO::PARAM_INT);
    $stmt->bindParam(':quality', $quality, PDO::PARAM_INT);
    $stmt->bindParam(':professionalism', $professionalism, PDO::PARAM_INT);
    $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);

    $stmt->execute();

    $updateStmt = $db->prepare(
      'UPDATE Jobs SET hasReview = 1 WHERE job_id = :job_id'
    );

    $updateStmt->bindParam(':job_id', $jobId, PDO::PARAM_INT);
    $updateStmt->execute();
    $db->commit();

    return true;
    
  } catch (Exception $e) {
    $db->rollBack();
    return false;
  }
}

function getReviewsByJobId($job_id) {
  global $db;
  
  $stmt = $db->prepare("
      SELECT * FROM Reviews 
      WHERE job_id = :job_id
  ");
  $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC); // Returns all reviews associated with this job
}


/*
function addReview($reviewerId, $contractorId, $communication, $time_management, $quality, $professionalism, $comments) {
  global $db;

  $stmt = $db->prepare(
    'INSERT INTO Reviews (reviewer_id, contractor_id, communication, time_management, quality, professionalism, comments) 
    VALUES (:reviewer_id, :contractor_id, :communication, :time_management, :quality, :professionalism, :comments)'
  );

  $stmt->bindParam(':reviewer_id', $reviewerId, PDO::PARAM_INT);
  $stmt->bindParam(':contractor_id', $contractorId, PDO::PARAM_INT);
  $stmt->bindParam(':communication', $communication, PDO::PARAM_INT);
  $stmt->bindParam(':time_management', $time_management, PDO::PARAM_INT);
  $stmt->bindParam(':quality', $quality, PDO::PARAM_INT);
  $stmt->bindParam(':professionalism', $professionalism, PDO::PARAM_INT);
  $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);

  return $stmt->execute();
}

function getReviewsByJobId($job_id) {
  global $db;
  
  $stmt = $db->prepare("
      SELECT * FROM Reviews 
      WHERE job_id = :job_id
  ");
  $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC); // Returns all reviews associated with this job
}

*/