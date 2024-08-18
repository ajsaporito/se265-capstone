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

?>