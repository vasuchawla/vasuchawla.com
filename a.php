<?php
$file_path = 'json_data.csv';
$secret="Mercanow2016";

die();

$headers = apache_request_headers();

if(!isset($headers['Signature']))
die('no signature');


$sig_to_match = $headers['Signature'];
$received = file_get_contents("php://input");
if($received=="")
   die('no data');

$sig_created = hash_hmac('sha256', $received, $secret);

if($sig_created!=$sig_to_match)
	die('SIGNATURE DOESNT MATCH');

 
$json =  json_decode($received,true);
if($json)
{
	$node_mac = $json['node_mac'];
	$network_id = $json['network_id'];
	$data_csv_array = $json['probe_requests'];
	foreach(array_keys($data_csv_array[0]) as $key){
		$keys[0][$key] = $key;
	}

	// $data_csv_array = array_merge($keys, $data_csv_array);
	$fileIO = fopen($file_path, 'a+');
	foreach ($data_csv_array as $fields) {
		$fields['node_mac']=$node_mac;
		$fields['network_id']=$network_id;

		fputcsv($fileIO, $fields);
	}
	fclose($fileIO);
	echo 'done';
	die(); 
}else
{
	die('NO JSON');
}