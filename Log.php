<?php
/*
* Class de Log usando SQLite3
* By Fernando Valler
* Obs: definir um nome unico para base
*
* Exemplos
* //insert
* Log::add('REGISTRO DE LOG DO SISTEMA '. date("G:i"), 'ADMIN', 1);
* echo '<hr>';
* 
* //find id
* $results = Log::find(1);
* var_dump($results);
* echo '<hr>';
* 
* //delete id
* $delete = Log::delete(15);
* var_dump($delete);
* echo '<hr>';
* 
* //find all
* $results2 = Log::findAll();
* var_dump($results2);
* 
* //Where
* $results2 = Log::findAll("cat='SYSTEM'");
* var_dump($results2);
*/
class Log {    

	private static $db;	
	private static $file_root = '';
	private static $file_name = 'e9de5fe3588ed52a13ae0cc9bf90f0791223e3ef71b781910f056467c549f';
	private static $file_path = '/Projetos/Log-SQLite/db/';

    public static function open($path_root){
		// Database Connection
		self::$file_root = $path_root;

		if(self::$file_root && self::$file_path){
			self::create_folder();
		}
		
		self::$db = new SQLite3(self::$file_root . self::$file_path . self::$file_name);
		self::create_table();
    }

    private static function create_folder(){
    	if(!file_exists(self::$file_root . self::$file_path)){
    		mkdir(self::$file_root . self::$file_path, 0777, true);
    	}
    }

    private static function create_table(){        
    	if(self::$db){
			// Create Table "logs" into Database if not exists 
			$query = "CREATE TABLE IF NOT EXISTS logs (msg STRING, cat STRING, tipo INT, data STRING)";
			return self::$db->exec($query);      		
    	}	  	
    }    

    public static function add($msg, $cat = 'SYSTEM', $tipo = 0){        
    	if($msg){					
			$query = "INSERT INTO logs (msg, cat, tipo, data) VALUES ('$msg', '$cat', '$tipo', datetime('now', 'localtime'))";
			return self::$db->exec($query);      		
    	}	  	
    }    

    public static function update($id, $msg){            						
    	if($id && $msg){
			$query = "UPDATE logs SET msg = '$msg' WHERE rowid = '$id'";					
			$stmt = self::$db->query($query);		
			return $stmt->fetchArray();	
		}		
    }    

    public static function find($id){            						
    	if($id){
			$query = "SELECT rowid as id, * FROM logs WHERE rowid = '$id'";					
			$stmt = self::$db->query($query);		
			while($row = $stmt->fetchArray()){
				$results[] = $row;
			}
			return $results;
		}		
    }

    public static function findAll($where = ''){            						
    	$w = !empty($where) ? "AND {$where}":'';
		$query = "SELECT rowid as id, * FROM logs WHERE 1=1 $w ORDER BY rowid DESC";		
		$stmt = self::$db->query($query);		
		while($row = $stmt->fetchArray()){
			$results[] = $row;
		}			
		return $results;
    }    

    public static function delete($id){    
    	if($id){
			$query = "DELETE FROM logs WHERE rowid = '$id' LIMIT 1";
			$stmt = self::$db->query($query);
			return $stmt->fetchArray();			
    	}		
    }



}

Log::open($_SERVER["DOCUMENT_ROOT"]);