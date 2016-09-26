<?php
/* Enter your params here */
$jsonFile = "example.json";
$outputFile = "command.sql";
$database = "MyDatabase";
$table = "MyTable";

jsonToSql($jsonFile, $outputFile, $database, $table);

function jsonToSql($jsonFile, $outputFile, $database, $table) {
	$json = file_get_contents($jsonFile); 
	$data = json_decode($json);
	$fp = fopen ($outputFile, "w");
	$i = 0;
	foreach ($data as $obj) {
		$name = $obj->name;
		$fullname = $obj->fullname;
		$address = $obj->address;
		$name = addslashes($name);
		$sql = "INSERT INTO `$database`.`$table` (`ID`, `NAME`, `FULLNAME`, `ADDRESS`) VALUES (NULL, '$name', '$fullname', '$address');\n";
		fputs ($fp, $sql);
		$i++;
	}
	echo "Done. File ".$outputFile." has been created with ".$i." entries.\n";
}

?>