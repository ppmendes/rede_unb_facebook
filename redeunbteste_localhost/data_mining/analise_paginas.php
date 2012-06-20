<?php
    
    //abrindo conexao para gravação dos dados
	ini_set('max_execution_time','120');
	
	include_once 'config/conexao.inc';
    $conexao = new Conexao("localhost");
    $conexao->Open();
    //modificar a cada instância
    $query_consulta_fanpage = "SELECT * from fanpage_fb_user FROM fanpage_fb_user";    
	$consulta_fanpage = pg_query($conexao->con(), $query_consulta_fanpage);
	$consulta_fanpageids_rows = pg_fetch_all($consulta_fanpage);
	
	$page_id = array();
	
	$i = 0;
	foreach($consulta_fanpageids_rows as $consulta_fanpageids_rows_arr)
	{
		//$user_id = $consulta_fanpageids_rows_arr['userid_fanpage_likes'];
		$page_id_temp = $consulta_fanpageids_rows_arr['pageid_fanpage_likes'];
		//contar a quantidade de vezes que o mesmo valor de $page_id aparece
		if($i == 0)
		{
			$page_id[$i] = $page_id_temp;
			$page_id[$i]['count'] = 1;
		}
		else
		{
			//se repetir
			//checar se repete
			for($j = 0; $j < sizeof($page_id); $j++)
			{
				if($page_id[$j] == $page_id_temp)
				{
					$page_id[$j]['count']++;
				}
			}
			$i++;
		}
		//inserindo no banco de dados
		$query_fanpage = "INSERT INTO fanpage (pageid_fanpage, name_fanpage, picture, likes, category, description, talking_about_count) VALUES ($1, $2, $3, $4, $5, $6, $7)";
		pg_prepare($conexao->con(), "", $query_fanpage);
		pg_execute($conexao->con(), "", array($pageid_fanpage, $name_fanpage, $picture, $likes, $category, $description, $talking_about_count ));
	}
	 
   	$conexao->Close();
?>       
</html>