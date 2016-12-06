<?php
//url: "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/getByteStat.php",
$json = file_get_contents('http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/getByteStat.php');
//$json = file_get_contents('http://localhost/OCDXGroupProject/services/getByteStat.php');
$array = json_decode($json);
echo number_format($array->Sum);
?>
