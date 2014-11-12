<?php
include 'function.php';
checkLogin();
getHeader("ebas Aufgaben");
getNavigation();

if(array_key_exists('task', $_POST)){
  $taskname = $_POST['task'];

  if($taskname=='Bereinigungslauf'){

    
  }

}else{
?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

        <h1 class="page-header">Aufgaben</h1>

        <h2>Bereinigungslauf</h2>
        <p>Interessenten die sich angemeldet haben in der Datenbank löschen.</p>
        <button type="button" class="btn btn-default run-Bereinigungslauf">Ausführen</button>
        <p>
        <div class="alert alert-success Bereinigungslauf hide" role="alert"></div>
        <div class="alert alert-alert-warning Bereinigungslauf hide" role="alert"></div>
        </p>
      </div>
      <div class="col-md-2"></div>
  </div>
</div>

<?php getFooter();} ?>
