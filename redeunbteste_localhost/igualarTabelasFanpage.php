<?php
    
    //abrindo conexao para gravação dos dados
	ini_set('max_execution_time','106540');
	
	include_once 'config/conexao.inc';
    $conexao = new Conexao("locaweb");
    $conexao->Open();
    
    //modificar a cada instância
    $query_consulta_fanpageids = "select * from fanpage";    
	$consulta_fanpageids = pg_query($conexao->con(), $query_consulta_fanpageids);
	$consulta_fanpageids_rows = pg_fetch_all($consulta_fanpageids);
	$conexao->Close();
	
	$conexao_local = new Conexao("localhost");
	$conexao_local->Open();
	
	foreach($consulta_fanpageids_rows as $fanpageids_rows)
	{
		//$page_id = $consulta_fanpageids_rows_arr['pageid_fanpage_likes'];
		$pageid_fanpage = $fanpageids_rows['pageid_fanpage'];
		$name_fanpage = $fanpageids_rows['name_fanpage'];
		$picture = $fanpageids_rows['picture'];
		$likes = @$fanpageids_rows['likes'];
		$category = $fanpageids_rows['category'];
		$description = @$fanpageids_rows['description'];			
		$talking_about_count = @$fanpageids_rows['talking_about_count'];
		//inserindo no banco de dados
		$query_fanpage = "INSERT INTO fanpage (pageid_fanpage, name_fanpage, picture, likes, category, description, talking_about_count) VALUES ($1, $2, $3, $4, $5, $6, $7)";
		pg_prepare($conexao_local->con(), "", $query_fanpage);
		pg_execute($conexao_local->con(), "", array($pageid_fanpage, $name_fanpage, $picture, $likes, $category, $description, $talking_about_count ));
	}
	 
   	$conexao_local->Close();
?>       
</html>