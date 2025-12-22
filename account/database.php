<?php

require_once("dbConnect.php");
//require_once("perlConfig.php");
class Process{
    
    protected $dbCnx;

    public function __construct(){
            

            $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER,DB_PWD,[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            $this->dbCnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $this->dbCnx->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    
        }
        
        public function InsertData($query,$inputs = []){
            try{
                
                $stmt = $this->dbCnx->prepare($query);
                
                $stmt->execute($inputs);
                return  true;
            }catch(PDOException $e){
                
                throw new exception($e->getMessage());
            }
        }
        public function GetRows($query,$inputs = []){
            try{
                
                $stmt = $this->dbCnx->prepare($query);
                
                $stmt->execute($inputs);
                
                return  $stmt->fetchAll();
            }catch(PDOException $e){
                
                throw new exception($e->getMessage());
            }
        }
        public function GetRow($query,$inputs = []){
            try{
                
                $stmt = $this->dbCnx->prepare($query);
                
                $stmt->execute($inputs);
                
                return  $stmt->fetch();
            }catch(PDOException $e){
                
                throw new exception($e->getMessage());
            }
        }
        public function Check($query,$inputs = []){
            try{
                $stmt  = $this->dbCnx->prepare($query);
                $stmt->execute($inputs);
                
                if($stmt->fetchColumn()){
                    
                    return true;
                }else{
                    
                    return false;
                }
            }catch(PDOException $e){
                throw new exception($e->getMessage());
            }
        }

        public function UpdateData($query,$inputs = []){
            try{
                
                $stmt = $this->dbCnx->prepare($query);
                
                $stmt->execute($inputs);
                return  true;
            }catch(PDOException $e){
                
                throw new exception($e->getMessage());
            }
        }
        public function GetSum($query,$inputs = []){
        
            try{
                
                $stmt = $this->dbCnx->prepare($query);
                $stmt->execute($inputs);
                
                return $stmt->fetchColumn();
            }catch(PDOException $e){
                
                throw new exception($e->getMessage());
            }
        }

        public function DeletingData($query,$inputs = []){
        
            try{
                $stmt = $this->dbCnx->prepare($query);
                $stmt->execute($inputs);
                
                return true;
            }catch(PDOException $e){
                
                throw new exception($e->getMessage());
            }
        }

        function keepXLines($str, $num=4) {
            $lines = explode("\n", $str);
            $firsts = array_slice($lines, 0, $num);
            return implode("\n", $firsts);
        }

        function timeago($date) {
            $timestamp = strtotime($date);	
            
            $strTime = array("second", "minute", "hour", "day", "month", "year");
            $length = array("60","60","24","30","12","10");
        
            $currentTime = time();
            if($currentTime >= $timestamp) {
                 $diff     = time()- $timestamp;
                 for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                 $diff = $diff / $length[$i];
                 }
        
                 $diff = round($diff);
                 if($diff == 1) {
                     if($i == 3) {
                         return "Yesterday";
                     }else {
                         return $diff . " " . $strTime[$i] . " ago ";
                     }
                 }else {
                     return $diff . " " . $strTime[$i] . "s ago ";
                 }
            }
         }
        
    
}
$process = new Process();



?>