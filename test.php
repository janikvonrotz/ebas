<?php

// http://stackoverflow.com/questions/4076988/php-json-encode-json-decode-utf-8

    $string = "très öäü agréable";
    // to the database
    $j_encoded = json_encode($string);
    // get from Database
    $j_decoded = json_decode($j_encoded);
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 </head>
<body>
   <?= $j_decoded ?>
   <?= "très öäü agréable" ?>
</body>
</html>
