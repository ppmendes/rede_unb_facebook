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
    			$userid = $userInfo['id'];
    			//'select name, education, uid, work, website, music,  email, political, education_history, birthday_date, meeting_sex, work_history, hometown_location, languages, current_location, sex from user where uid IN ( SELECT uid2 FROM friend WHERE uid1 ={0})', '100002601798006'
    			//uid, username, name, pic_square, 
    			$dados = 'uid, username, name, pic_square, profile_update_time, birthday_date, sex,'.
    					 'hometown_location, relationship_status, significant_other_id, political, activities, interests,'. 
    					  'current_location, is_app_user, quotes, about_me, wall_count, online_presence,'.
    					  'locale, profile_url, profile_blurb, family, website, work, education,'.
    					  'languages, likes_count, friend_count, can_post';
    			
    			$dados_likes = 'music, tv, movies, books, games, sports, favorite_athletes, favorite_teams, inspirational_people';
    			//   significant_other_id, profile_update_time, religion, birthday_date, sex, pic_square, education
    			$fql_amigos = "select name, likes_count, $dados_likes from user where uid IN ( SELECT uid2 FROM friend WHERE uid1 = $userid )";
    			$param  =   array(
    					'method'    => 'fql.query',
    					'query'     => $fql_amigos,
    					'callback'  => ''
    			);
    			$dadosAmigos = $facebook->api($param);
    			//pra pegar todos os likes de uma pessoa deve-se  usar primeiro 
    			//SELECT uid2 FROM friend WHERE uid1 = $userid
    			//capturando assim todos os amigos de uid1
    			//depois checar um a um num for
    			//selecting page_id from page_fan
    			//dentro disto um outro "for" pra capturar o nome da página
    			//SELECT name, fan_count FROM page WHERE page_id = 19292868552
    			//construindo o array de maneira adequada
    			//mas antes disso checar se a quantidade dos likes de likes_count é muito destoante do total de $dados_likes
    			/*$fql_amigos_likes = "select page_id, type, profile_section, created_time from page_fan where uid IN ( SELECT uid2 FROM friend WHERE uid1 = $userid )";
    			$param2  =   array(
    					'method'    => 'fql.query',
    					'query'     => $fql_amigos_likes,
    					'callback'  => ''
    			);
    			$dadosAmigosLikes = $facebook->api($param2);*/
    			
    		}
    		catch(Exception $o){
    			d($o);
    		}
    		
    		$qtd_amigos = sizeof($dadosAmigos);
    		//checando possíveis dados de serem coletados
    		//var_dump($userInfo);
    		echo "</BR></BR></BR>";
    		///for($i = 0; $i < $qtd_amigos; $i++)
    		for($i = 0; $i < $qtd_amigos; $i++)
    		{
    		echo "nome".$dadosAmigos[$i]['name'];
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['music']));
    		var_dump($dadosAmigos[$i]['music']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['tv']));
    		var_dump($dadosAmigos[$i]['tv']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['movies']));
    		var_dump($dadosAmigos[$i]['movies']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['books']));
    		var_dump($dadosAmigos[$i]['books']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['games']));
    		var_dump($dadosAmigos[$i]['games']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['sports']));
    		var_dump($dadosAmigos[$i]['sports']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['favorite_athletes']));
    		var_dump($dadosAmigos[$i]['favorite_athletes']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['favorite_teams']));
    		var_dump($dadosAmigos[$i]['favorite_teams']);
    		echo "quantidade total de músicas que o usuário gosta".sizeof(explode(",", $dadosAmigos[$i]['inspirational_people']));
    		var_dump($dadosAmigos[$i]['inspirational_people']);
    		echo "quantidade total".$dadosAmigos[$i]['likes_count'];
    		
    		/*$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['tv']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['movies']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['books']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['games']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['sports']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['favorite_athletes']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['favorite_teams']);
    		$total_pagesfan_user_table += sizeof($dadosAmigos[$i]['inspirational_people']);*/
	    	//echo $dadosAmigos[$i]['name']." curtiu ".$dadosAmigos[$i]['likes_count']." páginas sendo da tabela usuário um total de".$total_pagesfan_user_table."destas";
    		//var_dump($dadosAmigos[$i]);
    		echo "</BR></BR></BR>";
    		}
    		
    		/*$qtd_amigos = sizeof($dadosAmigosLikes);
    		 //checando possíveis dados de serem coletados
    		//var_dump($userInfo);
    		echo "</BR></BR></BR>";
    		///for($i = 0; $i < $qtd_amigos; $i++)
    		for($i = 0; $i < $qtd_amigos; $i++)
    		{
	    		var_dump($dadosAmigosLikes[$i]);
	    		echo "</BR></BR></BR>";
	    	}*/
    		
    		
    		//checando se a pessoa estudou na Universidade de Brasília
    		/*for($i = 0; $i < $qtd_amigos; $i++)
    		{
    			$amigoDaVez = $dadosAmigos[$i];
    			$arrayEducacao = $amigoDaVez['education'];
    			
    			$qtdInstituicoesEducadionaisAmigos = sizeof($arrayEducacao);

    		    for($j = 0; $j < $qtdInstituicoesEducadionaisAmigos ; $j++)
    		    {
    		    	//pessoas que marcaram a página da UnB com id 106254912746370
    		    	$InstituicaoEducacionalDaVez = $arrayEducacao[$j]['school'];
    		    	
    		    	if( $InstituicaoEducacionalDaVez['id'] == 106254912746370)
    		    	{
    		    		echo $dadosAmigos[$i]['name']." estudou na Universidade de Brasília";
    		    		echo var_dump($arrayEducacao[$j]);
    		    		echo "</br></br>";
    		    	}
    		    	//pessoas que marcaram a página da UnB com id 113901608620360
    		    	else if( $InstituicaoEducacionalDaVez['id'] == 113901608620360)
    		    	{
    		    		echo $dadosAmigos[$i]['name']." estudou na Universidade de Brasília";
    		    		echo var_dump($arrayEducacao[$j]);
    		    		echo "</br></br>";
    		    	}
    		    }
    			
    		}*/
    		
    		
     	} ?>    
     
</html>