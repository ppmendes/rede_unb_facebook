<?php
    include_once "fbmain.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
        <title>Rede UnB Facebook</title>
    </head>
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
    <h3>Rede UnB Facebook</h3>

    <?php if (!$user) { 
        echo "Sua sessão está expirada."; 
    	echo "<a href='$loginUrl'>Facebook Login</a>";
     }
     if ($user){
    		try{
    		//consulta ao banco de dados
    		//$page_id
			$fql_page = "Select name, type, categories, fan_count, page_url, username, pic_square, website FROM page WHERE page_id = $page_id";
			$param_page  =   array(
					'method'    => 'fql.query',
					'query'     => $fql_page,
					'callback'  => ''
			);
			$dadosPagina = $facebook->api($param_page);
			
    		}catch(Exception $o){
    			d($o);
    		}
    		
     	} ?>    
     
</html>