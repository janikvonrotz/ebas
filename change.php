<?php
include 'function.php';

// contains id for delete and update methods
if (array_key_exists('id', $_GET)){
  $id = $_GET['id'];
}
// either insert, delete or update
if (array_key_exists('action', $_GET)){
  $action = $_GET['action'];
}
// contains table name
if (array_key_exists('table', $_GET)){
  $table = $_GET['table'];
}

$Config = getConfig();
$conn = DBConnect();


// get sqlname of id
if($table =="Kurse"){
  $idname = "kurs_id";
}
elseif($table =="Anmeldungen"){
  $idname = "anmeldung_id";
}
elseif($table == "Interessenten"){
  $idname = "interessent_id";
}
// get sqlname of table
foreach ($Config["tables"] as $itable){
  if($itable["name"]== $table){
    $table = $itable["sqlname"];
  }
}


if($action == "delete"){

  // delete entry with $id and $table
  $sql ="DELETE FROM ".$table." WHERE ".$idname." = ".$id;

echo $sql;

mysqli_query($conn, $sql);
mysqli_close($conn);
}

?>
