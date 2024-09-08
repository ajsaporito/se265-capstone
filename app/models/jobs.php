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

function getJobById($job_id) {
    global $db;

    $stmt = $db->prepare("SELECT * FROM Jobs WHERE job_id = :id");
    $stmt->bindValue(':id', $job_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// **8-17 For ADD-JOBS.php (not in use currently and testing still)**
function saveJobWithSkills($jobData, $skills) {
    global $db;

    try {
        $db->beginTransaction();

        // Insert the job into the Jobs table
        $stmt = $db->prepare("INSERT INTO Jobs (posted_by, title, description, budget, status, job_type, hourly_rate, estimated_hours_per_week, estimated_completion_date)
                              VALUES (:posted_by, :title, :description, :budget, :status, :job_type, :hourly_rate, :estimated_hours_per_week, :estimated_completion_date)");
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


?>