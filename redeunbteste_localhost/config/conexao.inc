<?php

Class Conexao{
	
	/* declaracao das variaveis de conexao com banco de dados */
	private $host;
	private $user;
	private $pswd;
	private $banco;
	private $strCon;
	private $con;
	
	function Conexao($tipoConexao){
		if($tipoConexao == 'locaweb')
		{
			require_once 'db_constants_locaweb.inc';
			$this->host = DBC::HOST;
			$this->user = DBC::USER;
			$this->pswd = DBC::PASSWORD;
			$this->banco = DBC::DB;
		}
		else if ($tipoConexao == 'localhost')
		{
			require_once 'db_constants_localhost.inc';
			$this->host = DBC2::HOST;
			$this->user = DBC2::USER;
			$this->pswd = DBC2::PASSWORD;
			$this->banco = DBC2::DB;
		}
		
		$this->strCon 	= " host=$this->host user=$this->user password=$this->pswd dbname=$this->banco ";
	}
	
	/* abre conexao com banco de dados */
	function Open(){
		$this->con = pg_connect($this->strCon);
	}
	
	/* executa query */
	function Query($query){		
	@$sql = pg_query($this->con,
    $query);        
    return $sql;
	}

    function con() {
        return $this->con;
    }
	
	function Select($query){		
	$result = pg_query($this->con,$query);    
	$arr = pg_fetch_all($result);	
	return $arr;
	}
	
	function Select2($query){		
		$result = pg_query($this->con,$query);   
		return $result;
	}
	
	/* fecha conexao com banco de dados */
	function Close(){
		pg_close($this->con);
	}
	
	/* testa conexao com banco */
	function StatusCon(){
		if(!$this->con){
			echo "<h3>O sistema no est conectado   [$this->banco] em [$this->host].</h3>";
		exit;
		}else{
			echo "<h3>O sistema est conectado   [$this->banco] em [$this->host].</h3>";
		}
	}

}
?>
