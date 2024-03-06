<?php
require './init.php' ;

$sql = 'SELECT id,pos FROM catalog';
$result = mysqli_fetch_all($db->query($sql), 1);
$meta_col = 'Мета: sorting_order';

foreach ($result as $item ) {
    list($id,$position) = [$item['id'],$item['pos']];
    $sql = "UPDATE old SET `$meta_col` = $position WHERE `Артикул` = $id";
    var_dump($sql)."\n";

    $db->query($sql);
}
