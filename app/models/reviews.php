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
  
  // Fetch all reviews for the user
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

function renderStars($rating) {
  $fullStars = str_repeat('★', $rating); // Full stars based on rating
  $emptyStars = str_repeat('☆', 5 - $rating); // Empty stars
  return '<span class="stars">' . $fullStars . $emptyStars . '</span>';
}

/*
// Function to get reviews by job ID, with optional user check
function GetReviewsByJobId($job_id, $user_id = null) {
  global $db;
  $results = [];

  $query = 'SELECT 
              r.comments, 
              r.communication, 
              r.time_management, 
              r.quality, 
              r.professionalism, 
              r.contractor_id, 
              r.reviewer_id, 
              r.job_id,
              u.username AS reviewer_name,
              u2.username AS contractor_name
            FROM Reviews r
            JOIN Users u ON r.reviewer_id = u.user_id
            JOIN Users u2 ON r.contractor_id = u2.user_id
            JOIN Jobs j ON r.job_id = j.job_id
            WHERE r.job_id = :job_id';

  // Add user check if $user_id is provided
  if ($user_id !== null) {
    $query .= " AND (j.posted_by = :user_id OR j.contractor_id = :user_id)";
  }

  $stmt = $db->prepare($query);
  $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);

  if ($user_id !== null) {
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  }

  if ($stmt->execute() && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  return $results;
}

// Function to add a job review
function AddJobReview($job_id, $reviewer_id, $contractor_id, $communication, $time_management, $quality, $professionalism, $comments) {
  global $db;

  $stmt = $db->prepare(
    'INSERT INTO Reviews (job_id, reviewer_id, contractor_id, communication, time_management, quality, professionalism, comments) 
    VALUES (:job_id, :reviewer_id, :contractor_id, :communication, :time_management, :quality, :professionalism, :comments)'
  );

  $stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
  $stmt->bindParam(':reviewer_id', $reviewer_id, PDO::PARAM_INT);
  $stmt->bindParam(':contractor_id', $contractor_id, PDO::PARAM_INT);
  $stmt->bindParam(':communication', $communication, PDO::PARAM_INT);
  $stmt->bindParam(':time_management', $time_management, PDO::PARAM_INT);
  $stmt->bindParam(':quality', $quality, PDO::PARAM_INT);
  $stmt->bindParam(':professionalism', $professionalism, PDO::PARAM_INT);
  $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);

  return $stmt->execute();
}

*/