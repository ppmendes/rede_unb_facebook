<?php

include_once '../config/conexao.inc';
$conexao = new Conexao("localhost");
$conexao->Open();
//modificar a cada instância
$query_consulta_cityids = "SELECT current_location_id, hometown_location_id from fb_user";

$consulta_cityids = pg_query($conexao->con(), $query_consulta_cityids);
$consulta_cityids_rows = pg_fetch_all($consulta_cityids);

$id_temp = 0;
foreach($consulta_cityids_rows as $consulta_cityids_rows_arr )
{
	$currenttown = $consulta_cityids_rows_arr['current_location_id'];	
	$hometown = $consulta_cityids_rows_arr['current_location_id'];
	
	$currenttown_ids = explode(",", $currenttown);
	$hometown_ids = explode(",", $hometown);
	for($i = 0; $i = sizeof($currenttown_ids); $i++)
	{
		$currenttown_ids
	}
	//coletar todos os ids current, hometown e depois os dois juntos
	//fazer consulta com estes ids pra ver
	echo $pieces[0]; // piece1
	echo $pieces[1]; // piece2
}

$conexao->Close();
?>