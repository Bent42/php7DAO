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
    		$row = $result[0];
    		$this->setUsucod($row["usucod"]);
    		$this->setUsulogin($row["usulogin"]);
    		$this->setUsusenha($row["ususenha"]);
    		$this->setUsudtcadastro(new DateTime($row["usudtcadastro"]));
    	}

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