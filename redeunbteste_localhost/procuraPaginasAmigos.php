<?php
    include_once "fbmain.php";
    //abrindo conexao para gravação dos dados
    include_once 'config/conexao.inc';
    $conexao = new Conexao();
    $conexao->Open();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
        <title>Rede UnB Facebook</title>
    </head>
	
 
<?php 
if ($_SESSION['user']){
			$uid = $_REQUEST['uid'];
			$uids = $_REQUEST['uids'];
			$uids_array = explode(",", $uids);

			try{
				for($u = 0; $u < sizeof($uids_array); $u++)
				{
					$uidAmigoUnB = $uids_array[$u];
					echo "id".$uidAmigoUnB; 
					$fql_pagefan = "Select page_id from page_fan where uid = $uidAmigoUnB";
					$param_pagefan  =   array (
							'method'    => 'fql.query',
							'query'     => $fql_pagefan,
							'callback'  => '' );
					$UsuarioFanPages[$uidAmigoUnB] = $facebook->api($param_pagefan);
					var_dump($UsuarioFanPages[$uidAmigoUnB]);					
	    		}
			}	    		
    		catch(Exception $o){
	    			d($o);
    		}     		
}
//salvar primeiro dadosPessoaisUsuarios
//salvando saída do comando var_dump
//ob_start();
var_dump($UsuarioFanPages);
//$UsuarioFanPagesVarDump = ob_get_clean();
exit;


//gravar este dados no banco de dados para depois analisa-los
$query = "UPDATE objects_user SET objects_fanpagedata_user_userfriends = $1 where uid = '$uid' ";
pg_prepare($conexao->con(), "", $query);
pg_execute($conexao->con(), "", array($UsuarioFanPagesVarDump));
	    		
$conexao->Close();
?>