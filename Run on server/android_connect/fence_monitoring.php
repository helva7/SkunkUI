
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

//calculate the distance between the Skoo and safe area centre and select if distance greater than safe area radius
$sql = "

SELECT *

FROM (

	SELECT 
		l.id, 
		
		(6371*1000) * ACOS ( COS(RADIANS(l.latitude)) * COS(RADIANS(g.lat)) * COS( RADIANS(l.longitude) - RADIANS(g.lng) ) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(g.lat)) ) AS `distance`,
    	
		g.radius

	FROM (
		
		SELECT *
    
		FROM `skunk`.`location` l 
	
		WHERE (l.latitude !=0.00) AND ( l.longitude !=0.00)
		
		ORDER BY id DESC
			
		LIMIT 3 ) l, `skunk`.`geofence` g

) r, `skunk`.`geofence` g

WHERE r.distance >  g.radius";

$stmt= $pdo->prepare($sql);

$stmt->execute(); 

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

//print_r($stmt);


if ($count > 0){
	echo "******ALERT******";
	echo "<br>";
	echo "<br>";
	echo "The Skunk is out on his rumble!!!";
	echo "<br>";
	echo "<br>";
	echo "Catch the piglet!";
} else {
	echo "All good!";
}



?>