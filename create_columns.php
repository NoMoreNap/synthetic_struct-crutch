<?php
require './init.php' ;

$all = "SHOW COLUMNS FROM old";

$all = mysqli_fetch_all($db->query($all),1);

foreach($all as $col) {

    $name = $col['Field'];
    if ($name === 'id_col') {
        continue;
    }

    $sql = "ALTER TABLE old MODIFY COLUMN `$name` text NOT NULL;";
    $db->query($sql);
}