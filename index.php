<?php 

require_once("config.php");
$sql = new Sql();

$root = new Usuario();
//busca um usuario
//$root->loadById(5);

//echo $root;

//carrega uma lista

//$lista = Usuario::list();

//echo json_encode($lista);

//carrega uma lista de usuarios buscando pelo login

//$search = Usuario::search("mo");

//echo json_encode($search);

//carrega o usuario usando o login e a senha

$usuario = new Usuario();

$usuario->login("Lamora42","3212");

echo $usuario;



 ?>