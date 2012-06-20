<?php 
//fazer outra consulta aqui para coletar as informações sobre as páginas do usuários

echo "qtd de páginas que o usuário curti ".sizeof($UsuarioFanPages)."</BR>";
				if(sizeof($UsuarioFanPages) > 0)
				{
					for($j = 0; $j < sizeof($UsuarioFanPages); $j++ )
					{
					echo $page_id = $UsuarioFanPages[$j]['page_id'];										
					$query = "INSERT INTO fanpage_likes (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
					pg_prepare($conexao->con(), "", $query);
					pg_execute($conexao->con(), "", array($uid_amigo, $page_id));
					}
				}
?>