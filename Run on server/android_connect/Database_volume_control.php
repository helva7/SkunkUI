
<?php


$host = '127.0.0.1'; // address that 000web (currently mySQL DB)

// your database name
$db   = 'skunk';

// username
$user = 'root';

// password
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;";

try {
     $pdo = new PDO($dsn, $user, $pass);
	 
} catch (\PDOException $e) {
	
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


//select last 5000 rows to be kept in DB

$sql = "

DELETE l 

FROM 

		location AS l

	Join 
		(
		Select id
		FROM location
		ORDER BY id DESC 
			LIMIT 1 OFFSET 4999
		) AS lim
			
		ON l.id < lim.id";
		
$stmt= $pdo->prepare($sql);

$stmt->execute(); 

//$stmt->setFetchMode(PDO::FETCH_ASSOC);

//$count = $stmt->rowCount();

print_r($stmt);



?>




















	