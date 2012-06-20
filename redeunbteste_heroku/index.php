<?php
	session_start();
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
          	if(!isset($_REQUEST['coletapaginas']))
    		try{
    			$_SESSION['userid'] = $userid = $userInfo['id'];
    			//mesmo sendo pequeno compensa colocar religion, political
    			//online_presence não funciona
    			//profile_blurb tem no perfil de menos pessoas e pouco preenchido quando comparado ao about_me
    			//family tem uma tabela especial e nao foi englobado neste trabalho
    			//website tem muito pouco tambÃ©m portanto foi tirado daqui
    			//profile_blurb, family,
    			//$dados_likes = 'music, tv, movies, books, games, sports, favorite_athletes, favorite_teams, inspirational_people, online_presence,';
    			$dados = 'name, uid, username, pic_square, profile_update_time, birthday_date, sex,'.
    					 'hometown_location, political, religion, activities, interests,'. 
    					  'current_location, is_app_user, quotes, about_me, '.
    					  'locale, education, languages, friend_count';
    			
    			$fql_amigos = "select $dados from user where uid IN ( SELECT uid2 FROM friend WHERE uid1 = $userid ) OR uid = $userid ";
    			$param  =   array(
    					'method'    => 'fql.query',
    					'query'     => $fql_amigos,
    					'callback'  => ''
    			);
    			$dadosAmigos = $facebook->api($param);
    			
    			
    			//verificando que Ã© da unb
    			for($k = 0; $k < sizeof($dadosAmigos) ; $k++)
    			{
	    			for($e = 0; $e < sizeof($dadosAmigos[$k]['education']); $e++)
	    			{
	    				//verificando os amigos que estudam na UnB
	    					
	    					if($dadosAmigos[$k]['education'][$e]['school']['id'] == '106254912746370' || $dadosAmigos[$k]['education'][$e]['school']['id'] == '113901608620360' || $dadosAmigos[$k]['education'][$e]['school']['id'] == '110771118944979')
	    					{
	    						//$uidAmigoUnB[$k]['uid'] = $dadosAmigos[$k]['uid']."</BR>";
	    						$_SESSION['dadosAmigosUnB'][$k] = $dadosAmigos[$k];
	    						echo $dadosAmigos[$k]['name']."</BR>";
	    						break;//para repetir usuários
	    					}
	    			}
    			}

    			$dadosAmigosUnBjson = json_encode($_SESSION['dadosAmigosUnB']);
    			
    			
    			//gravar este dados no banco de dados para depois analisa-los
    			$query = "INSERT INTO objects_user (uid, objects_personaldata_user_userfriends) VALUES ($1, $2)";
    			pg_prepare($conexao->con(), "", $query);
    			pg_execute($conexao->con(), "", array($userid, $dadosAmigosUnBjson));
    			
    			$_SESSION['cliques_botao_total_coletar_paginas'] =  ceil(sizeof($_SESSION['dadosAmigosUnB'])/50);
    			$_SESSION['cliques_botao_total_coletar_paginas_temp'] = sizeof($_SESSION['dadosAmigosUnB'])/50;
    			$_SESSION['cliques_botao_coletar_paginas'] = 1;
    			
    			?>
    			Aperte este botão para começarmos a coleta das informações das páginas que você e seus amgios que fazem UnB curtem.
				Este procedimento se repetirá <?php echo ceil($_SESSION['cliques_botao_total_coletar_paginas_temp']); ?>, 
    			pois este aplicativo só pode coletar informações de 50 usuários de cada vez e você tem <?php echo $_SESSION['cliques_botao_total_coletar_paginas_temp']*50 ?> 
				amigos. Obrigado pela compreensão!
				<button onclick="top.location.href = 'http://apps.facebook.com/rede_unbteste?coletapaginas=sim'">Agora Coletar Páginas</button>
    			<?php 
    		}
    		catch(Exception $o){
		    			d($o);
	    			}
          }  
    			
    			if(isset($_REQUEST['coletapaginas']))
    			{
    			try{
				$j = 0;    			    			
	    		foreach($_SESSION['dadosAmigosUnB'] as $dadosAmigosUnBArr)
				{
					
					if($j >= ($_SESSION['cliques_botao_coletar_paginas'] - 1)*50 ){	
					$uidAmigoUnB = $dadosAmigosUnBArr['uid'];
					$fql_pagefan = "Select page_id from page_fan where uid = $uidAmigoUnB";
					$param_pagefan  =   array (
							'method'    => 'fql.query',
							'query'     => $fql_pagefan,
							'callback'  => '' );
					$UsuarioFanPages[$uidAmigoUnB] = $facebook->api($param_pagefan);					
					}
					
					if($j == $_SESSION['cliques_botao_coletar_paginas']*50)
					{
						break;
					}
					
					$j++;
	    		}
	    		 
	    		$_SESSION['cliques_botao_total_coletar_paginas_temp']--;
	    		$_SESSION['cliques_botao_coletar_paginas']++;
	    		}catch(Exception $o){
		    			d($o);
	    			}  

	    		
	    		$UsuarioFanPagesJson = json_encode($UsuarioFanPages);
	    		
	    		$uid = $_SESSION['userid'];
	    		$i = ($_SESSION['cliques_botao_coletar_paginas'] -1);
	    		$query = "UPDATE objects_user SET objects_fanpagedata_user_userfriends$i = $1 where uid = '$uid'";
	    		pg_prepare($conexao->con(), "", $query);
	    		pg_execute($conexao->con(), "", array($UsuarioFanPagesJson));
	    		if($_SESSION['cliques_botao_coletar_paginas'] == ($_SESSION['cliques_botao_total_coletar_paginas'] + 1))
	    		{
	    			echo "Coleta Concluída! Obrigado!";
	    			echo "<script>alert('Coleta Concluída! Obrigado!')</script>";
	    			//dessetando variaveis de sessão
	    			unset($_SESSION['cliques_botao_total_coletar_paginas']);
	    			unset($_SESSION['cliques_botao_total_coletar_paginas_temp']);
	    			unset($_SESSION['cliques_botao_coletar_paginas']);
					//finalizando o script
	    			exit;
	    		} 		
	    		?>
	    		Aperte este botão para começarmos a coleta das informações das páginas que você e seus amgios que fazem UnB curtem.
				Este procedimento se repetirá <?php echo ceil($_SESSION['cliques_botao_total_coletar_paginas_temp']); ?>, 
    			pois este aplicativo só pode coletar informações de 50 usuários de cada vez e você ainda tem mais <?php echo $_SESSION['cliques_botao_total_coletar_paginas_temp']*50 ; ?>
				amigos.
    			<button onclick="top.location.href = 'http://apps.facebook.com/rede_unbteste?coletapaginas=sim'">Agora Coletar Páginas</button>
    			
	    		<?php 	    		
	     		} 
	     		
	     	
	     	$conexao->Close();
     	?>       
</html>