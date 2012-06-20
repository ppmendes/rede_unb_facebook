<?php 		
/*
 *  Arquivo que analisa os dados pessoais coletados, os decompõe e grava no banco de dados
 *  @author Pedro Paulo Mendes Pereira
 */
				ini_set('max_execution_time','120');
				
				include_once 'config/conexao.inc';
				$conexao_locaweb = new Conexao("locaweb");
				$conexao_locaweb->Open();
				//inseri o id do dado coletado
				$uid1 = "1061006105";
				//ids que já foram coletados
				//uid = 100000210809090 - diogo lisita
				//uid = 540328325 - Pedro Paulo Mendes
				//uid = 697985181 - Danilo Filgueira
				//uid = 100002108512333 - Bruno Santos (Gazela)
				//uid = 100002089067563 - Tatiana Veloso
				//uid = 100000292192204 - Pamela Hilario
				//uid = 739709839 - Roberto Braga
				//uid = 667130518 - Matheus Pereira Lima
				//uid = 100000564357648 - Moyses Lacerda
				//uid = 100000706900538 - Leandro Rezende
				//uid = 100002220275955 - Alberto Júnior
				//uid = 1018014034 - Raphael Vicente Rosa
				//uid = 1061006105 - Vinny Lima
				
				$query_consulta_dados_pessoais = "SELECT objects_fanpagedata_user_userfriends1, objects_fanpagedata_user_userfriends2,  
				objects_fanpagedata_user_userfriends3, objects_fanpagedata_user_userfriends4, objects_fanpagedata_user_userfriends5, 
				objects_fanpagedata_user_userfriends6, objects_fanpagedata_user_userfriends7, objects_fanpagedata_user_userfriends8, 
				objects_fanpagedata_user_userfriends9, objects_fanpagedata_user_userfriends10, objects_fanpagedata_user_userfriends11,
				objects_fanpagedata_user_userfriends12, objects_fanpagedata_user_userfriends13, objects_fanpagedata_user_userfriends14
				FROM objects_user where uid = '$uid1'";
				$consulta_dados_pessoais = pg_query($conexao_locaweb->con(), $query_consulta_dados_pessoais);
				$row = pg_fetch_all($consulta_dados_pessoais);
				$conexao_locaweb->Close();

				//conexão com banco de dados localhost
				$conexao_localhost = new Conexao("localhost");
				$conexao_localhost->Open();
				//consulta1
				$consulta_fanpage_decoded1 = json_decode($row[0]['objects_fanpagedata_user_userfriends1'], true);
				if($consulta_fanpage_decoded1){
				foreach ($consulta_fanpage_decoded1 as $consulta_fanpage_decoded1_pages) {
					$page_uid = key($consulta_fanpage_decoded1);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded1[$page_uid]){
					foreach($consulta_fanpage_decoded1[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded1);
					echo "</BR>";
				}}		
				//consulta2				
				$consulta_fanpage_decoded2 = json_decode($row[0]['objects_fanpagedata_user_userfriends2'], true);
				if($consulta_fanpage_decoded2){
				foreach ($consulta_fanpage_decoded2 as $consulta_fanpage_decoded2_pages) {
					$page_uid = key($consulta_fanpage_decoded2);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded2[$page_uid]){
					foreach($consulta_fanpage_decoded2[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded2);
					echo "</BR>";
				}}	
				//consulta3
				$consulta_fanpage_decoded3 = json_decode($row[0]['objects_fanpagedata_user_userfriends3'], true);
				if($consulta_fanpage_decoded3){
				foreach ($consulta_fanpage_decoded3 as $consulta_fanpage_decoded3_pages) {
					$page_uid = key($consulta_fanpage_decoded3);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded3[$page_uid]){
					foreach($consulta_fanpage_decoded3[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded3);
					echo "</BR>";
				}}	
				//consulta4
				$consulta_fanpage_decoded4 = json_decode($row[0]['objects_fanpagedata_user_userfriends4'], true);
				if($consulta_fanpage_decoded4){
				foreach ($consulta_fanpage_decoded4 as $consulta_fanpage_decoded4_pages) {
					$page_uid = key($consulta_fanpage_decoded4);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded4[$page_uid]){
					foreach($consulta_fanpage_decoded4[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded4);
					echo "</BR>";
				}}	
				//consulta5
				$consulta_fanpage_decoded5 = json_decode($row[0]['objects_fanpagedata_user_userfriends5'], true);
				if($consulta_fanpage_decoded5){
				foreach ($consulta_fanpage_decoded5 as $consulta_fanpage_decoded5_pages) {
					$page_uid = key($consulta_fanpage_decoded5);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded5[$page_uid]){
					foreach($consulta_fanpage_decoded5[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded5);
					echo "</BR>";
				}}	
				//consulta6
				$consulta_fanpage_decoded6 = json_decode($row[0]['objects_fanpagedata_user_userfriends6'], true);
				if($consulta_fanpage_decoded6){
				foreach ($consulta_fanpage_decoded6 as $consulta_fanpage_decoded6_pages) {
					$page_uid = key($consulta_fanpage_decoded6);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded6[$page_uid]){
					foreach($consulta_fanpage_decoded6[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded6);
					echo "</BR>";
				}}	
				//consulta7
				$consulta_fanpage_decoded7 = json_decode($row[0]['objects_fanpagedata_user_userfriends7'], true);
				if($consulta_fanpage_decoded7){
				foreach ($consulta_fanpage_decoded7 as $consulta_fanpage_decoded7_pages) {
					$page_uid = key($consulta_fanpage_decoded7);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded7[$page_uid]){
					foreach($consulta_fanpage_decoded7[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded7);
					echo "</BR>";
				}}	
				//consulta8
				$consulta_fanpage_decoded8 = json_decode($row[0]['objects_fanpagedata_user_userfriends8'], true);
				if($consulta_fanpage_decoded8){
				foreach ($consulta_fanpage_decoded8 as $consulta_fanpage_decoded8_pages) {
					$page_uid = key($consulta_fanpage_decoded8);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded8[$page_uid]){
					foreach($consulta_fanpage_decoded8[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded8);
					echo "</BR>";
				}}	
				//consulta9
				$consulta_fanpage_decoded9 = json_decode($row[0]['objects_fanpagedata_user_userfriends9'], true);
				if($consulta_fanpage_decoded9){
				foreach ($consulta_fanpage_decoded9 as $consulta_fanpage_decoded9_pages) {
					$page_uid = key($consulta_fanpage_decoded9);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded9[$page_uid]){
					foreach($consulta_fanpage_decoded9[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded9);
					echo "</BR>";
				}}	
				//consulta10
				$consulta_fanpage_decoded10 = json_decode($row[0]['objects_fanpagedata_user_userfriends10'], true);
				if($consulta_fanpage_decoded10){
				foreach ($consulta_fanpage_decoded10 as $consulta_fanpage_decoded10_pages) {
					$page_uid = key($consulta_fanpage_decoded10);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded10[$page_uid]){
					foreach($consulta_fanpage_decoded10[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded10);
					echo "</BR>";
				}}	
				//consulta11
				$consulta_fanpage_decoded11 = json_decode($row[0]['objects_fanpagedata_user_userfriends11'], true);
				if($consulta_fanpage_decoded11){
				foreach ($consulta_fanpage_decoded11 as $consulta_fanpage_decoded11_pages) {
					$page_uid = key($consulta_fanpage_decoded11);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded11[$page_uid]){
					foreach($consulta_fanpage_decoded11[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded11);
					echo "</BR>";
				}}	
				//consulta12
				$consulta_fanpage_decoded12 = json_decode($row[0]['objects_fanpagedata_user_userfriends12'], true);
				if($consulta_fanpage_decoded12){
				foreach ($consulta_fanpage_decoded12 as $consulta_fanpage_decoded12_pages) {
					$page_uid = key($consulta_fanpage_decoded12);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded12[$page_uid]){
					foreach($consulta_fanpage_decoded12[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded12);
					echo "</BR>";
				}}	
				//consulta13
				$consulta_fanpage_decoded13 = json_decode($row[0]['objects_fanpagedata_user_userfriends13'], true);
				if($consulta_fanpage_decoded13){
				foreach ($consulta_fanpage_decoded13 as $consulta_fanpage_decoded13_pages) {
					$page_uid = key($consulta_fanpage_decoded13);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded13[$page_uid]){
					foreach($consulta_fanpage_decoded13[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded13);
					echo "</BR>";
				}}	
				//consulta14
				$consulta_fanpage_decoded14 = json_decode($row[0]['objects_fanpagedata_user_userfriends14'], true);
				if($consulta_fanpage_decoded14){
				foreach ($consulta_fanpage_decoded14 as $consulta_fanpage_decoded14_pages) {
					$page_uid = key($consulta_fanpage_decoded14);
					echo "page uid: ".$page_uid."</br>";
					if(@$consulta_fanpage_decoded14[$page_uid]){
					foreach($consulta_fanpage_decoded14[$page_uid] as $fanpages_pageid)
					{
						$pageid = $fanpages_pageid['page_id'];
						echo "page id: ".$pageid;
						$query_insercao_fanpages = "INSERT INTO fanpage_fb_user (userid_fanpage_likes, pageid_fanpage_likes) VALUES ($1, $2)";
						pg_prepare($conexao_localhost->con(), "", $query_insercao_fanpages);
						pg_execute($conexao_localhost->con(), "", array($page_uid, $pageid));
					}}
					@next($consulta_fanpage_decoded14);
					echo "</BR>";
				}}	
				
				$conexao_localhost->Close();
?>