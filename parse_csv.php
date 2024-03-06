<?php
require './init.php' ;
$all = "SHOW COLUMNS FROM old";

$all = mysqli_fetch_all($db->query($all),1);
$cols = [];
foreach($all as $col) $cols[] = $col['Field'];

if (($fp = fopen("./old.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
		$list[] = $data;
	}
	fclose($fp);
}
$iter = 0;

foreach($list as $item) {
    $cols_names = "";
    $values = "";

    for ($i=0; $i < count($cols); $i++) { 
        $colname = $cols[$i];
        if ($colname === 'id_col') {
            continue;
        }
        $value = $item[$i-1] ?? '';
        $value = str_replace("'",'’',$value);
        if ($i != count($cols) -1) {
            $values .= "'$value',";
            $cols_names .= "`$colname`,";
        } else {
            $cols_names .= "`$colname`";
            $values .= "'$value'";

        }
    }
    $sql = "INSERT INTO `old`($cols_names) VALUES ($values)";
    try {
        $result = $db->query($sql);
    } catch (\Throwable $th) {
        var_dump($sql);
        break;
    }

    
}
