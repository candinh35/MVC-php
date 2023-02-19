<?php

class Image extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('images');
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->tableName  WHERE student_id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE student_id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}