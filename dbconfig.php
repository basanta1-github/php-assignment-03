<?php 
$host = 'localhost:3306'; //I had my port no set to 3307 as I have configured all of my sql, java on 3307 only
$user = 'root';
$password = '6969';
$dbname = 'accounts';

$dsn = "mysql:host=$host;dbname=$dbname" ;

try {
    $pdo = new PDO($dsn, $user, $password);
    echo "Connection is successful";
}
catch(PDOException $e){
echo "Database gone".$e->getMessage();
}

?>