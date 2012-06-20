<?php

include_once '../config/conexao.inc';
$conexao = new Conexao("localhost");
$conexao->Open();
//modificar a cada instância
$query_consulta_fanpageids = "SELECT fp.name_fanpage, fp_fb_user.pageid_fanpage_likes, fp.category, fp.talking_about_count, count(fp_fb_user.pageid_fanpage_likes) FROM fanpage_fb_user as fp_fb_user INNER JOIN fanpage as fp ON fp.pageid_fanpage = fp_fb_user.pageid_fanpage_likes where fp.category ilike 'Entertainer' or fp.category ilike 'Actor' or fp.category ilike 'Fictional character' or fp.category ilike 'Public figure' or fp.category ilike 'Journalist'
GROUP BY fp_fb_user.pageid_fanpage_likes, fp.name_fanpage, fp.category, fp.talking_about_count, fp.likes ORDER BY count(fp_fb_user.pageid_fanpage_likes) DESC";

$consulta_fanpageids = pg_query($conexao->con(), $query_consulta_fanpageids);
$consulta_fanpageids_rows = pg_fetch_all($consulta_fanpageids);

$soma_likes = 0;
foreach($consulta_fanpageids_rows as $consulta_fanpageids_rows_arr)
{
	$soma_likes += $consulta_fanpageids_rows_arr['count'];
}
echo $soma_likes;

$conexao->Close();
?>