<?php
    namespace Models;
    use PDO;
    class DB
    {
        private static $instanca = null;
        private $host = 'localhost';
        private $db = 'osiguranje';
        private $username = 'root';
        private $password = '';
        private $con;
        
        private function __construct()
        {
            try{
                $this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8", $this->username, $this->password);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            catch(PDOException $msg){
                echo $msg;
            }
           
        }
        public static function getInstance()
        {
            if(!self::$instanca)
            {
                self::$instanca = new DB();
            }
        
            return self::$instanca;
        }
        public function getConnection()
        {
            return $this->con;
        }
    }
?>