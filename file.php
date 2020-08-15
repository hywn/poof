<?php
$hash = $_GET['hash'] or die('invalid hash');

$db = new SQLite3('./posts.db');

$statement = $db->prepare('select * from files where hash = :hash');
$statement->bindValue(':hash', $hash);

list(, $type, $data) = $statement->execute()->fetcharray(SQLITE3_NUM);

if (!$type)
	die('invalid hash');

header("content-type: $type");

echo $data;
?>