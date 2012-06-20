<?php

require_once 'db_constants.inc';

Class Conexao{
	
	/* declaracao das variaveis de conexao com banco de dados */
	private $host = DBC::HOST;
	private $user = DBC::USER;
	private $pswd = DBC::PASSWORD;
	private $banco = DBC::DB;
	private $strCon;
	private $con;
	
	function Conexao(){
			
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
