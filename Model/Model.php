<?php
require_once "DB.php";
class Model extends DB
{
    protected $tableName;

    public function __construct()
    {
        parent::__construct();
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function getAll()
    {
        $query = "SELECT * FROM $this->tableName";
        $result = $this->connect->query($query);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        try {
            $sql = "INSERT INTO $this->tableName ($columns) VALUES ($placeholders)";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute($data);
            return $this->connect->lastInsertId();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($id, $data)
    {
        // Lặp qua dữ liệu cập nhật để xây dựng câu truy vấn
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        // Xóa dấu phẩy cuối cùng của câu truy vấn
        $setClause = rtrim($setClause, ', ');
        // Tạo câu truy vấn SQL
        $sql = "UPDATE $this->tableName SET $setClause WHERE id = :id";

        // Thực thi truy vấn
        $stmt = $this->connect->prepare($sql);

        // Bind giá trị cho tham số id
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Lặp qua dữ liệu cập nhật và bind giá trị cho từng trường
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindParam(":id", $id);
        // Thực thi câu truy vấn
        $stmt->execute();

        // Trả về số bản ghi được cập nhật
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->tableName  WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
