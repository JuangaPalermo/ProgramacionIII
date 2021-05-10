<?php 

echo "va por GET <br>";
var_dump($_GET);

echo "<br>va por POST<br>";
var_dump($_POST);

echo "Bienvenido/a ", $_POST["txtNombre"];

?>