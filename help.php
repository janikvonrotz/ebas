<?php
include 'function.php';
checkLogin();
getHeader("ebas Hilfe");
getNavigation();
?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

        <h1 class="page-header">Hilfe</h1>

        <div class="tableselects">
          <?php
          foreach ($fields as $field){
            $drop = getDropdownHtmlByField($field);
            if($drop){echo $drop;}
          }
          ?>
        </div>

      </div>
      <div class="col-md-2"></div>
  </div>
</div>

<?php getFooter(); ?>
