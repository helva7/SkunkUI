
<?php

// insert into DB with PHP PDO
// https://www.w3schools.com/php/php_mysql_connect.asp


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


if (isset ($_POST['latitude'])){
	$latitude = $_POST['latitude'];
}
else 
{
  $latitude = null;
  echo "didn't get latitude";
  echo "<br>";
}

if (isset ($_POST['longitude'])){
	$longitude = $_POST["longitude"];
}
else 
{
  $longitude = null;
  echo "didn't get longitude";
  echo "<br>";
}

//$longitude = $_POST['longitude'];
//$speed =  $_POST['speed'];


$sql = "INSERT INTO location (latitude, longitude) VALUES (?,?)";

$stmt= $pdo->prepare($sql);

$stmt->execute([$latitude, $longitude]); 



//var_dump($_POST);

print_r($_POST);

//echo $_POST['longitude']."\n";
//echo $_POST['latitude'];


//print_r($_SERVER['REQUEST_METHOD']);

?>
