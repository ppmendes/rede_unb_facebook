<?php

include_once 'config/conexao.inc';
$conexao = new Conexao("localhost");
$conexao->Open();
//modificar a cada instância
$query_consulta_activities = "SELECT uid, languages_names from fb_user";
$consulta_activities = pg_query($conexao->con(), $query_consulta_activities);
$consulta_activities_rows = pg_fetch_all($consulta_activities);

foreach($consulta_activities_rows as $consulta_activities_rows_arr)
{
	$uid = $consulta_activities_rows_arr['uid'];
	$activities = $consulta_activities_rows_arr['languages_names'];
	$activities_arr = explode(",", $activities);
	if($activities)
	{
		foreach($activities_arr as $activities_sem_virgula)
		{
			$query_insert_uid_activity = "INSERT INTO languages_fb_user(uid, language) VALUES($1,$2)";
			pg_prepare($conexao->con(), "", $query_insert_uid_activity);
			pg_execute($conexao->con(), "", array($uid, $activities_sem_virgula));
		}
	}
}


$conexao->Close();
?>