<?php
    
    //abrindo conexao para gravação dos dados
	ini_set('max_execution_time','106540');
	
	include_once 'config/conexao.inc';
    $conexao = new Conexao("localhost");
    $conexao->Open();

	

    /*$page_id_old = "105911002790789" ;
    $page_id_new = "339374429464250" ;
    //substituir id antigo pelo novo na tabela fanpage_fb_user    
    $query_fanpage_fb_user = "UPDATE fanpage_fb_user SET pageid_fanpage_likes = $1 WHERE pageid_fanpage_likes = $2 ";
    pg_prepare($conexao->con(), "", $query_fanpage_fb_user);
    pg_execute($conexao->con(), "", array($page_id_new, $page_id_old ));*/
    //inserir os dados da nova página na tabela fanpage
    
	//$url = "http://graph.facebook.com/$page_id_new";
    $url = "http://graph.facebook.com/152353204812617";
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
	
	 
   	$conexao->Close();
?>       
</html>