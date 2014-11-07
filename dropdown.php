<?php
include 'function.php';
checkLogin();
$id = $_GET['table'];

$Config = getConfig();
$conn = DBConnect();

// create an json response with dropdown code:

[
  {
    "field": "Kurs",
    "dropdown": "<select><option\nvalue=\"1\">Item 1</option><option  value=\"2\">Item\n2</option><option value=\"n\">tem\nN</option></select>"
  },
  {
    "field": "Sprache",
    "dropdown": "<select><option\nvalue=\"1\">Item 1</option><option  value=\"2\">Item\n2</option><option value=\"n\">tem\nN</option></select>"
  }
]

?>
