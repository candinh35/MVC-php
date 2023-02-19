<?php
class DB {
    private $serverName = 'localhost';
    private $database = 'student';
    private $user = 'root';
    private $password = '';
    protected $connect = null;
    protected $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_TIMEOUT => 5,
    ];

    public function __construct()
    {
        try {
            $this->connect = new PDO("mysql:host=$this->serverName;dbname=$this->database", $this->user, $this->password, $this->options);
        } catch (\Throwable $th) {
            $this->connect = null;
            die ("Could not connect to the database $this->database :" . $th->getMessage());
        }
        
    }
}
