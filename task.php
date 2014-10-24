<?php
include 'function.php';
getHeader("ebas Aufgaben");
getNavigation();

?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

        <h1 class="page-header">Aufgaben</h1>

        <?php

        $Config = getConfig();
        echo $Config["user"];
        echo $Config["password"];

        echo $Config["tables"][0]["name"];
        echo $Config["tables"][0]["fields"][0]["sqlname"];

        foreach ($Config["tables"] as $table) {
          echo $table["name"];
          if($table["name"] == "Kurse"){
            $CurrentTable = $table;
          }

        }
        echo $CurrentTable["sqlname"];

        ?>

      </div>
      <div class="col-md-2"></div>
  </div>
</div>

<?php getFooter(); ?>
