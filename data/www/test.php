<?php
$client=new Redis();
$client->connect('docker-redis', 6379);
$client->set('a', '123');
echo $client->get('a');

echo '-----------------<br>';

$user='root';
$password='';
$dsn="mysql:host=docker-mysql;dbname=mysql";

try {
    $dbh = new PDO($dsn, $user, $password);
    foreach ($dbh->query('SELECT `Host`, `User` FROM `user` LIMIT 1') as $row) {
        var_dump($row);
    }
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}

phpinfo();