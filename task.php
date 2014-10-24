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

        getConfig();
        echo $Config["user"];

        ?>

      </div>
      <div class="col-md-2"></div>
  </div>
</div>

<?php getFooter(); ?>
