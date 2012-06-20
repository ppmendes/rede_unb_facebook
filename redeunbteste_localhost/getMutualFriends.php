<?php
	//session_start();
    include_once "fbmain.php";
    //abrindo conexao para gravação dos dados
  //  include_once 'config/conexao.inc';
    //$conexao = new Conexao();
    //$conexao->Open();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
	<div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
     //ajuste janela para firefox
   	    FB.init({
                appId  : '<?=$fbconfig['appid']?>',
                status : true, // check login status
                cookie : true, // enable cookies to allow the server to access the session
                xfbml  : true  // parse XFBML
              });

     </script>
     </head>	
    <?php if (!$user) { 
        echo "Sua sessão está expirada."; 
    	echo "<a href='$loginUrl'>Facebook Login</a>";
     }
          if ($user){
    		try{
    			$uid1 = "100000564357648";
    			$uid2 = "615803588";
    			
    			$fql_amigos = "SELECT uid1, uid2 FROM friend 
							   WHERE uid1 = 100000564357648 
							   AND uid2 = me()"; 
    			$param  =   array(
    					'method'    => 'fql.query',
    					'query'     => $fql_amigos,
    					'callback'  => ''
    			);
    			$dadosAmigos = $facebook->api($param);
    			var_dump($dadosAmigos);
    			
    			
          	}
          	catch(Exception $o) {
          		print_r($o);
          	}
          }
    
	?>