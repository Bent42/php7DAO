<?php 

class Usuario{

	private $usucod;
	private $usulogin;
	private $ususenha;
	private $usudtcadastro;

	public function getUsucod(){
		return $this->usucod;
	}
	public function getUsulogin(){
		return $this->usulogin;		
	}
	public function getUsusenha(){
		return $this->ususenha;	
	}
	public function getUsudtcadastro(){
		return $this->usudtcadastro;
	}

    public function setUsucod($codigo){
    	$this->usucod = $codigo;
    }
    public function setUsulogin($login){
    	$this->usulogin = $login;
    }
    public function setUsusenha($senha){
    	$this->ususenha = $senha;
    }
    public function setUsudtcadastro($data){
    	$this->usudtcadastro = $data;
    }

    public function loadById($codigo){

    	$sql = new Sql();
    	$result = $sql->SELECT("SELECT * FROM usuarios where usucod = :codigo",array(
    		":codigo"=>$codigo
    	));

    	if (count($result)>0) {
    		
    		$this->setDados($result[0]);
    	}

    }


	public static function list(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios order by usulogin");
	}

	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios where usulogin like :search order by usulogin",array(

			"search"=>"%".$login."%"

		));
	}

	public function login($login, $senha){
		$sql = new Sql();
    	$result = $sql->SELECT("SELECT * FROM usuarios where usulogin = :login and ususenha = :senha",array(
    		":login"=>$login,
    		":senha"=>$senha
    	));

    	if (count($result)>0) {
    		
    		$this->setDados($result[0]);

    	}else{

    		throw new Exception("Login ou senha invalidos!!", 1);
    		
    	}
	}

	public function setDados($dados){

    		$this->setUsucod($dados["usucod"]);
    		$this->setUsulogin($dados["usulogin"]);
    		$this->setUsusenha($dados["ususenha"]);
    		$this->setUsudtcadastro(new DateTime($dados["usudtcadastro"]));		

	}

	public function __construct($login="",$senha=""){

		$this->setUsulogin($login);
		$this->setUsusenha($senha);
	}

	public function insert(){

		$sql = new Sql();

		$result = $sql->select("CALL p_usuarios_insert(:login, :senha)",array(
			":login"=>$this->getUsulogin(),
			":senha"=>$this->getUsusenha()
		));

		if (count($result)>0) {
			$this->setDados($result[0]);
		}
	}

	public function update($login, $senha){

		$this->setUsulogin($login);
		$this->setUsusenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE usuarios SET usulogin = :login, ususenha = :senha where usucod = :codigo",array(
			":login"=>$this->getUsulogin(),
			":senha"=>$this->getUsusenha(),
			":codigo"=>$this->getUsucod()
		));
	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM usuarios where usucod = :codigo",array(
			":codigo"=>$this->getUsucod()

		));

		$this->setUsucod(0);
		$this->setUsulogin("");
		$this->setUsusenha("");
		$this->setUsudtcadastro(new DateTime());

	}

    public function __toString(){

    	return json_encode(array(
    		"usucod"=>$this->getUsucod(),
    		"usulogin"=>$this->getUsulogin(),
    		"ususenha"=>$this->getUsusenha(),
    		"usudtcadastro"=>$this->getUsudtcadastro()->format("d/m/Y H:i:s")
    	));

    }    

}


 ?>