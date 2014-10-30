<?php
include 'function.php';

// contains id for delete and update methods
if(array_key_exists('id', $_POST)){
  $id = $_POST['id'];
}
// either insert, delete or update
if(array_key_exists('action', $_POST)){
  $action = $_POST['action'];
}
// contains table name
if(array_key_exists('table', $_POST)){
  $table = $_POST['table'];
}

$Config = getConfig();
$conn = DBConnect();

// get sqlname of table
foreach ($Config["tables"] as $itable){
  if($itable["name"]==$table){
      $table = $itable;
      $fields = $itable["fields"];
    }
}

if($action == "delete"){

  $sql ="DELETE FROM ".$table["sqlname"]." WHERE ".$fields[0]["sqlname"]." = ".$id;

  mysqli_query($conn, $sql);
  mysqli_close($conn);

}elseif($action == "update"){

  $Data = json_decode($_POST['data'],true);
  $sql = "INSERT ";

  foreach($fields as $field){

    $sql = $sql.$field["sqlname"]." = '".$Data[$field["name"]]."'";

    if($fields[count($fields) - 1]["name"] != $field["name"]){
      $sql = $sql.", ";
    }
  };

  $sql = $sql." WHERE";

  echo $sql;

}elseif($action == "insert"){


}

?>
