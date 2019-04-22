
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
	
	require 'vendor/autoload.php'; // If you're using Composer (recommended)
	// Comment out the above line if not using Composer
	// require("<PATH TO>/sendgrid-php.php");
	//require("C:\Users\helen\Documents\ITB\Diplom\Skunk\Run on server\android_connect\vendor\sendgrid\sendgrid/sendgrid-php.php");
	
	// If not using Composer, uncomment the above line and
	// download sendgrid-php.zip from the latest release here,
	// replacing <PATH TO> with the path to the sendgrid-php.php file,
	// which is included in the download:
	// https://github.com/sendgrid/sendgrid-php/releases

	$email = new \SendGrid\Mail\Mail(); 
	
	$email->setFrom("helenporter7@gmail.com", "Helen Porter");   /// change this to be your own email address you have with sendgid.
	
	$email->setSubject("*** ALERT ***");
	
	$email->addTo("helenporter7@gmail.com", "Skunk");
	
	$email->addContent("text/html", "The Skunk is out on his ramble!!!". "\r\n"."<strong> * Catch the piglet! * </strong>");
	
	$sendgrid = new \SendGrid('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'); // change  this to be your own API key.
	
	try {
		$response = $sendgrid->send($email);
		
		print $response->statusCode() . "\n";
		
		print_r($response->headers());
		
		print $response->body() . "\n";
		
	} catch (Exception $e) {

		echo 'Caught exception: '. $e->getMessage() ."\n";
	}

	echo "************ALERT************"."<br />"."<br />"."* The Skunk is out on his ramble!!! *"."<br />"."<br />"."* Catch the piglet! *"."<br />"."<br />"."******************************". "\n";	
	
} else {
	
	echo "All good!";
	
	}



?>