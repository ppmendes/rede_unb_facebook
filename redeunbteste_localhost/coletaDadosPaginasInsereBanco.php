<?php
    
    //abrindo conexao para gravação dos dados
	ini_set('max_execution_time','106540');
	
	include_once 'config/conexao.inc';
    $conexao = new Conexao("localhost");
    $conexao->Open();
    //modificar a cada instância
    $query_consulta_fanpageids = "SELECT DISTINCT pageid_fanpage_likes FROM fanpage_fb_user";    
	$consulta_fanpageids = pg_query($conexao->con(), $query_consulta_fanpageids);
	$consulta_fanpageids_rows = pg_fetch_all($consulta_fanpageids);
	
	foreach($consulta_fanpageids_rows as $consulta_fanpageids_rows_arr)
	{
		$page_id = $consulta_fanpageids_rows_arr['pageid_fanpage_likes'];
		$url = "http://graph.facebook.com/$page_id";			
		$fanpageids_rows = json_decode(file_get_contents($url), true);
		$pageid_fanpage = $fanpageids_rows['id'];
		$name_fanpage = $fanpageids_rows['name'];
		$picture = $fanpageids_rows['picture'];
		$likes = @$fanpageids_rows['likes'];
		$category = $fanpageids_rows['category'];
		$description = @$fanpageids_rows['description'];			
		$talking_about_count = @$fanpageids_rows['talking_about_count'];
		//inserindo no banco de dados
		$query_fanpage = "INSERT INTO fanpage (pageid_fanpage, name_fanpage, picture, likes, category, description, talking_about_count) VALUES ($1, $2, $3, $4, $5, $6, $7)";
		pg_prepare($conexao->con(), "", $query_fanpage);
		pg_execute($conexao->con(), "", array($pageid_fanpage, $name_fanpage, $picture, $likes, $category, $description, $talking_about_count ));
	}
	 
   	$conexao->Close();
?>       
</html>