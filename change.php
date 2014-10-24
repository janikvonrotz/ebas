<?php
include 'function.php';

// contains id for delete and update methods
$id = $_Request['id'];
// either insert, delete or update
$action = $_Request['action'];
// contains table name
$table = $_Request['table'];
// contains insert or update data
$data = $_Request['data'];

$Config = getConfig();
$Conn = DBConnect();

echo $id;
echo $table;
echo $action;

// get sqlname of table
foreach ($Config["tables"] as $itable){
  if($itable["name"]== table){
    $table = $itable["sqlname"];
  }
}

if($action == "delete"){

  // delete entry with $id and $table
}

?>
