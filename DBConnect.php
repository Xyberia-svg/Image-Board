<?php 

class DBConnect{
    private $user = 'root';
    private $pass = 'connectwired';
    private $host = 'localhost';

    private static $instance = null;
    private $PDO;

    private function __construct($DBname) {
        try {
            $this->PDO = new PDO("mysql:host=$this->host;dbname=$DBname", $this->user, $this->pass);
        } catch (Exception $e){
            echo 'error:'.$e;
        }
    }

    public static function getInstance($DBname){
        if (self::$instance == null){
            self::$instance = new DBConnect($DBname);
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->PDO;
    }

}

?>