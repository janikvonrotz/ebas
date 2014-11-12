<?php
include 'function.php';
checkLogin();

if(array_key_exists('task', $_POST)){
  $taskname = $_POST['task'];

  if($taskname=='Bereinigungslauf'){

      // ADD CODE

      // return amount of delete rows
      $response["count"]=5;
      echo json_encode($response);
  }

}else{

  getHeader("ebas Aufgaben");
  getNavigation();
?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

        <h1 class="page-header">Aufgaben</h1>

        <h2>Bereinigungslauf</h2>
        <p>Interessenten die sich angemeldet haben in der Datenbank löschen.</p>
        <button type="button" class="btn btn-default run-task" task="Bereinigungslauf">Ausführen</button>
        <p>
        <div class="alert alert-success Bereinigungslauf hide" role="alert">test</div>
        <div class="alert alert-warning Bereinigungslauf hide" role="alert">test</div>
        </p>
      </div>
      <div class="col-md-2"></div>
  </div>
</div>

<?php getFooter();} ?>
