<?php 

require_once("config.php");
$sql = new Sql();

$root = new Usuario();

$root->loadById(5);

echo $root;


 ?>