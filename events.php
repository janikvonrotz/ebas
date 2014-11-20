<?php
// is part of function.php

function runEvents($tablename,$trigger,$id){
  /*
    $tablename = name of current table
    $trigger = event to trigger
    $id = id of the current dataset
  */

  $Config = getConfig();
  $table = getTableByName($tablename);
  $fields = $table["fields"];
  $conn = DBConnect();

  // cycle through registered events
  foreach($Config["events"] as $Event){
    // check for event triggers
    if($Event["trigger"]==$trigger){

      $conditions = true;

      // check for certain condition
      if(array_key_exists('condition', $Event)){
        if(array_key_exists('tableis', $Event["condition"])){

          // table is condition
          if(!($table["name"]==$Event["condition"]["tableis"])){
            $conditions = false;
          }
        }
      }

      //if conditions true run tasks
      if($conditions){

        // copyfields event
        if($Event["task"]["name"]=="copyfields"){

          // run the task specific code
          $sqlselect = "SELECT ";
          foreach($Event["task"]["fieldmap"] as $fmap){

            // generate the select code to get all data from the databse
            $field = getFieldByName($fields,$fmap["source"])["sqlname"];
            $sqlselect = $sqlselect.$field." AS "."`".$fmap["destination"]."`";
            $Lastitem = $Event["task"]["fieldmap"][count($Event["task"]["fieldmap"])-1]["source"];
            if($fmap["source"] != $Lastitem){
              $sqlselect = $sqlselect.", ";
            }
          }
          $srctable = getTableByName($Event["condition"]["tableis"])["sqlname"];
          $sqlselect = $sqlselect." FROM ".$srctable." WHERE ".$fields[0]["sqlname"]." = ".$id;
          $result = mysqli_query($conn, $sqlselect);
          $row = mysqli_fetch_array($result, MYSQL_ASSOC);

          // run the insert code
          $desttable = getTableByName($Event["task"]["totable"])["sqlname"];
          $sqlinsert="INSERT into ".$desttable."(";
          $sqlinsert2=") VALUES(";

          // get all sqlfieldnames and values from last select
          foreach($Event["task"]["fieldmap"] as $fmap){
            $field = getFieldByName($fields,$fmap["destination"])["sqlname"];
            $sqlinsert = $sqlinsert."`".$field."`";
            $sqlinsert2 = $sqlinsert2."'".$row[$fmap["destination"]]."'";
            $Lastitem = $Event["task"]["fieldmap"][count($Event["task"]["fieldmap"])-1]["destination"];
            if($fmap["destination"] != $Lastitem){
              $sqlinsert = $sqlinsert.", ";
              $sqlinsert2 = $sqlinsert2.", ";
            }
          }

          // run the query
          $sqlinsert=$sqlinsert.$sqlinsert2.")";
          $result = mysqli_query($conn, $sqlinsert);
          return null;
        }

        // deletesameitems event
        if($Event["task"]["name"]=="deletesameitems"){

          // get sql name of the tables
          $sourcetable = getTableByName($Event["task"]["sourcetable"]);
          $deleteontable = getTableByName($Event["task"]["deleteontable"]);

          // Template: DELETE FROM tbl_interessenten_2014_2 WHERE email IN (SELECT email FROM tbl_anmeldungen_2014_2)
          // create select statement
          $sqldelete = "DELETE FROM ".$deleteontable["sqlname"]." WHERE ";
          foreach($Event["task"]["fieldmap"] as $fmap){

            // getsqlname for source field
            $sourcefield = getFieldByName($sourcetable["fields"],$fmap["source"]);

            // getsqlname for delete field
            $deletefield = getFieldByName($deleteontable["fields"],$fmap["destination"]);

            // delete condition
            $sqldelete = $sqldelete."(".$deletefield["sqlname"]." IN (SELECT ".$sourcefield["sqlname"]." FROM ".$sourcetable["sqlname"]."))";

            // sperate conditions
            $Lastitem = $Event["task"]["fieldmap"][count($Event["task"]["fieldmap"])-1];
            if($fmap != $Lastitem){
              $sqldelete = $sqldelete." && ";
            }
          }

          // run the statement
          mysqli_query($conn, $sqldelete);
          return mysqli_affected_rows($conn);
        }
      }
    }
  }

  DBClose($conn);
}
?>
