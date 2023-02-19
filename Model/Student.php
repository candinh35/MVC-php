<?php

require_once "DB.php";
require_once "Model.php";
class Student extends Model
{
    public function __construct() {
        parent::__construct();
        $this->setTableName('students');
     }

     public function getAll()
     {
        $query = "SELECT s.id,  s.name, s.birthday, s.address, GROUP_CONCAT(i.url) as image_urls
        FROM students s
        JOIN images i ON s.id = i.student_id
        GROUP BY s.id";
        $result = $this->connect->query($query);

        return $result->fetchAll(PDO::FETCH_ASSOC);
     }

     public function getById($id)
    {
        $query = "SELECT s.id,  s.name, s.birthday, s.address, GROUP_CONCAT(i.url) as image_urls
        FROM students s
        JOIN images i ON s.id = i.student_id
        WHERE id = :id
        GROUP BY s.id ";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}