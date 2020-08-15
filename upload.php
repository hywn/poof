<?php
$file_data = $_FILES['file_data'] or die(json_encode(array('success' => 'false', 'reason' => 'no file')));

// not yet sure if this useful but just nice to have it
if ($file_data['error'])
	die(json_encode(array('success' => 'false', 'reason' => 'error')));

$data = file_get_contents($file_data['tmp_name']);
$type = $file_data['type'];
$hash = sha1($data);

$db = new SQLite3('./files.db');
$db->enableExceptions(true);

$db->query('create table if not exists files (
	hash text not null,
	type text not null,
	data blob not null,

	unique(hash)
)');

$statement = $db->prepare('insert into files values (:hash, :type, :data)');
$statement->bindValue(':hash', $hash, SQLITE3_TEXT);
$statement->bindValue(':type', $type, SQLITE3_TEXT);
$statement->bindValue(':data', $data, SQLITE3_BLOB);

try {
	$statement->execute();
} catch (Exception $e) {
	die(json_encode(array('success' => 'false', 'reason' => 'collision', 'hash' => $hash)));
}

$response = array(
	'success' => true,
	'hash'    => $hash,
	'type'    => $type
);

echo json_encode($response);
?>