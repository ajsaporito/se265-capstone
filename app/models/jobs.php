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

    // Fetch the job details
    $stmt = $db->prepare("SELECT * FROM Jobs WHERE job_id = :id");
    $stmt->bindValue(':id', $job_id, PDO::PARAM_INT);
    $stmt->execute();
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($job) {
        // Fetch the associated skills
        $stmt = $db->prepare("SELECT Skills.skill_name FROM JobSkills
                              JOIN Skills ON JobSkills.skill_id = Skills.skill_id
                              WHERE JobSkills.job_id = :job_id");
        $stmt->bindValue(':job_id', $job_id, PDO::PARAM_INT);
        $stmt->execute();
        $job['skills'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $job;
}


// **8-17 For ADD-JOBS.php **
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
// New 8-19 for ADD-JOB.php when selecting skills for jobs
function getAllSkills() {
    global $db;

    $stmt = $db->prepare("SELECT DISTINCT skill_name, skill_id FROM Skills ORDER BY skill_name ASC");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>