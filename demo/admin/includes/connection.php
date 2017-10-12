<?php
class Connection{
	public static function dbConnection(){
		try{
			$dbconnect = new PDO('mysql:host=localhost;dbname=ramesb26_art','ramesb26_kannan','kamal@1979');
//$dbconnect = new PDO('mysql:host=localhost;dbname=kamalver_art','kamalver_kannan','kamal@1980');
			$result = $dbconnect->prepare("SET CHARACTER SET utf8");
			$result->execute();
			$result = $dbconnect->prepare("SET SESSION collation_connection ='utf8_general_ci'");
					$result->execute();
			return $dbconnect;
		}catch(PDOException $e){
			die($e->getMessage());
		}
		
	}
	
			public static function sqlSelect($pdo_connection,$sql){
			try{
					$result = $pdo_connection->prepare($sql);
					$result->execute();
					return $result->fetchAll(PDO::FETCH_OBJ);
				}catch(PDOException $e){
					die($e->getMessage());
				}
			}
			public static function paymentStatus($payment){
					switch ($payment){
						//$payment = array("Success","Abort","Failure");
							case 'Success': return 0;
							case 'Abort': return 1;
							case 'Failure': return 2;
					}
			}
			
			
		
}
?>