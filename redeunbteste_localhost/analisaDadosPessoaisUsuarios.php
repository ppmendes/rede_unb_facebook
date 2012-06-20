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
				
				$query_consulta_dados_pessoais = "SELECT objects_personaldata_user_userfriends FROM objects_user where uid = '$uid1'";
				$consulta_dados_pessoais = pg_query($conexao_locaweb->con(), $query_consulta_dados_pessoais);
				$row = pg_fetch_all($consulta_dados_pessoais);				
				$consulta_dados_pessoais_decoded = json_decode($row[0]['objects_personaldata_user_userfriends'], true);
				$conexao_locaweb->Close();
				
				$conexao_localhost = new Conexao("localhost");
				$conexao_localhost->Open();
				//analisando e tratando as informações de cada usuário
				echo "total de amigos".sizeof($consulta_dados_pessoais_decoded);
				$i = 1;
    			foreach($consulta_dados_pessoais_decoded as $consulta_dados_pessoais_decoded_arr)
    			{
    				
    				
    				echo "</BR>";
    				echo "</BR>";
    				echo "uid: ";
    				echo $tb_user_uid = $consulta_dados_pessoais_decoded_arr['uid'];
    				echo "</BR>";
    				echo "name: ";
    				echo $tb_user_name = $consulta_dados_pessoais_decoded_arr['name'];
    				echo "</BR>";
    				echo "username: ";
    				echo $tb_user_username = @$consulta_dados_pessoais_decoded_arr['username'];
    				echo "</BR>";
    				echo "pic: ";
    				echo $tb_user_pic_square = $consulta_dados_pessoais_decoded_arr['pic_square'];
    				echo "</BR>";
    				echo "profile update: ";
    				echo $tb_user_profile_update_time = $consulta_dados_pessoais_decoded_arr['profile_update_time'];
    				echo "</BR>";
    				echo "birthday: ";
    				echo $tb_user_birthday_date = @$consulta_dados_pessoais_decoded_arr['birthday_date'];
    				echo "</BR>";
    				echo "sex: ";
    				echo $tb_user_sex = @$consulta_dados_pessoais_decoded_arr['sex'];
    				echo "</BR>";
    				//verificar
    				echo "hometown location: ";
    				echo $tb_user_hometown_location_id = @$consulta_dados_pessoais_decoded_arr['hometown_location']['id'];
    				//dados para a tabela city
    				echo "</BR>";
    				$tb_city_hometown_id = @$consulta_dados_pessoais_decoded_arr['hometown_location']['id'];
    				echo "name: ";
    				echo $tb_city_hometown_name = @$consulta_dados_pessoais_decoded_arr['hometown_location']['city'];
    				echo "</BR>";
    				echo "state: ";
    				echo $tb_city_hometown_state = @$consulta_dados_pessoais_decoded_arr['hometown_location']['state'];
    				echo "</BR>";
    				echo "country: ";
    				echo $tb_city_hometown_country = @$consulta_dados_pessoais_decoded_arr['hometown_location']['country'];
    				echo "</BR>";
    				echo "relationship: ";
    				echo $tb_user_relationship_status = @$consulta_dados_pessoais_decoded_arr['relationship_status'];
    				echo "</BR>";
    				echo "pessoa da relationship: ";
    				echo $tb_user_significant_other_id = @$consulta_dados_pessoais_decoded_arr['significant_other_id'];
    				echo "</BR>";
    				echo "religion: ";
    				echo $tb_user_religion = @$consulta_dados_pessoais_decoded_arr['religion'];
    				echo "</BR>";
    				echo "political";
    				echo $tb_user_political = @$consulta_dados_pessoais_decoded_arr['political'];
    				echo "</BR>";
    				echo "activities: ";
    				echo $tb_user_activities = @$consulta_dados_pessoais_decoded_arr['activities'];
    				echo "</BR>";
    				echo "current location: ";
    				echo $tb_user_current_location_id = @$consulta_dados_pessoais_decoded_arr['current_location']['id'];
    				echo "</BR>";
    				//dados para a tabela city
    				$tb_city_current_id = @$consulta_dados_pessoais_decoded_arr['current_location']['id'];
    				echo "name";
    				echo $tb_city_current_name = @$consulta_dados_pessoais_decoded_arr['current_location']['city'];
    				echo "</BR>";
    				echo "state";    				
    				echo $tb_city_current_state = @$consulta_dados_pessoais_decoded_arr['current_location']['state'];
    				echo "</BR>";
    				echo "country";
    				echo $tb_city_current_country = @$consulta_dados_pessoais_decoded_arr['current_location']['country'];
    				echo "</BR>";
    				echo "is app user: ";
    				echo $tb_user_is_app_user =  @$consulta_dados_pessoais_decoded_arr['is_app_user'];
    				if($tb_user_is_app_user == '')
    				{
    					$tb_user_is_app_user = 0;//false
    				}
    				else 
    				{
    					$tb_user_is_app_user = 1;//true
    				}
    				echo "</BR>";
    				echo "quotes: ";
    				echo $tb_user_quotes =  @$consulta_dados_pessoais_decoded_arr['quotes'];
    				echo "</BR>";
    				echo "about me: ";
    				echo $tb_user_about_me =  @$consulta_dados_pessoais_decoded_arr['about_me'];
    				echo "</BR>";
    				echo "wall count: ";
    				echo $tb_user_wall_count =  @$consulta_dados_pessoais_decoded_arr['wall_count'];
    				echo "</BR>";
    				echo "idioma de uso do facebook: ";
    				echo $tb_user_locale =  @$consulta_dados_pessoais_decoded_arr['locale'];
    				echo "</BR>";
    				echo "profile url: ";
    				echo $tb_user_profile_url =  @$consulta_dados_pessoais_decoded_arr['profile_url'];
    				echo "</BR>";
    				echo "interests: ";
    				echo $tb_user_interests =  @$consulta_dados_pessoais_decoded_arr['interests'];
    				echo "</BR>";

    				//work que será gravado no banco separado por vírgula
    				echo $tb_user_work_ids = "";
    				for($w = 0; $w < sizeof(@$consulta_dados_pessoais_decoded_arr['work']); $w++)
    				{
    					if($w == 0)
    					{
    						$tb_user_work_ids = $tb_user_work_ids."".@$consulta_dados_pessoais_decoded_arr['work'][$w]['employer']['id'];
    						
    					}
    					else
    					{
    						$tb_user_work_ids = $tb_user_work_ids.",".@$consulta_dados_pessoais_decoded_arr['work'][$w]['employer']['id'];
    					}
    					
    					echo "employer id";
    					echo $tb_work[$w]['employer_id'] =  @$consulta_dados_pessoais_decoded_arr['work'][$w]['employer']['id'];
    					echo "</BR>";
    					echo "employer name";
    					echo $tb_work[$w]['employer_name'] =  @$consulta_dados_pessoais_decoded_arr['work'][$w]['employer']['name'];
    					echo "</BR>";
    					echo "location id";
    					echo $tb_work[$w]['location_id'] =  @$consulta_dados_pessoais_decoded_arr['work'][$w]['location']['id'];
    					echo "</BR>";
    					echo "location name";    					
    					echo $tb_work[$w]['location_name'] =  @$consulta_dados_pessoais_decoded_arr['work'][$w]['location']['name'];
    					echo "</BR>";
    					echo "position id";
    					echo $tb_work[$w]['position_id'] =  @$consulta_dados_pessoais_decoded_arr['work'][$w]['position']['id'];
    					echo "</BR>";
    					echo "position name";
    					echo $tb_work[$w]['position_name'] = @$consulta_dados_pessoais_decoded_arr['work'][$w]['position']['name'];
    					echo "</BR>";
    					echo "start date: ";
    					echo $tb_work[$w]['start_date'] = @$consulta_dados_pessoais_decoded_arr['work'][$w]['start_date'];
    					echo "</BR>";
    					echo "end date: ";
    					echo $tb_work[$w]['end_date'] = @$consulta_dados_pessoais_decoded_arr['work'][$w]['end_date'];
    					echo "</BR>";
    					echo "description: ";
    					echo $tb_work[$w]['description'] = @$consulta_dados_pessoais_decoded_arr['work'][$w]['description'];
    					echo "</BR>";

    					//quem a pessoa trabalhou
    					$tb_work[$w]['with_ids'] = "";    					
    					for($people_work = 0; $people_work < sizeof(@$consulta_dados_pessoais_decoded_arr['work'][$w]['with']); $people_work++)
    					{
    						if($people_work == 0)
    						{
    						 	$tb_work[$w]['with_ids'] = $tb_work[$w]['with_ids']."".@$consulta_dados_pessoais_decoded_arr['work'][$w]['with'][$people_work]['id'];
    						}
    						else
    						{
    							$tb_work[$w]['with_ids'] = $tb_work[$w]['with_ids'].",".@$consulta_dados_pessoais_decoded_arr['work'][$w]['with'][$people_work]['id'];
    						}
    					}
    					
	    					//colocar dados de $tb_work no banco de dados
    						$query_tb_work_fb_user = "INSERT INTO work_fb_user (uid, employer_id, location_id, location_name, position_id, position_name, with_ids, description, start_date, end_date) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
    						pg_prepare($conexao_localhost->con(), "", $query_tb_work_fb_user);
    						pg_execute($conexao_localhost->con(), "", array($tb_user_uid, $tb_work[$w]['employer_id'], $tb_work[$w]['location_id'], $tb_work[$w]['location_name'], $tb_work[$w]['position_id'], $tb_work[$w]['position_name'], $tb_work[$w]['with_ids'], $tb_work[$w]['description'], $tb_work[$w]['start_date'], $tb_work[$w]['end_date']));
    						
    						//atualizar dados da instuição de trabalho
    						@$query_tb_work = "INSERT INTO work (employer_id, employer_name) VALUES ($1, $2)";
    						@pg_prepare($conexao_localhost->con(), "", $query_tb_work);
    						@pg_execute($conexao_localhost->con(), "", array($tb_work[$w]['employer_id'], $tb_work[$w]['employer_name']));
    				}
    				
    				echo "employer ids: ".@$tb_user_work_ids;
    				echo "</BR>";
    				echo "work whith ids: ".@$tb_work[$w]['with_ids'];
    				echo "</BR>";
    				
    				//education que será gravado no banco separado por vírgula
    				echo $tb_user_education_ids = "";
    				for($e = 0; $e < sizeof(@$consulta_dados_pessoais_decoded_arr['education']); $e++)
    				{
	    					if($e == 0)
	    					{
	    							$tb_user_education_ids = $tb_user_education_ids."".@$consulta_dados_pessoais_decoded_arr['education'][$e]['school']['id'];
    						}
    						else
    						{
    								$tb_user_education_ids = $tb_user_education_ids.",".@$consulta_dados_pessoais_decoded_arr['education'][$e]['school']['id'];
    						}    						
    						
    						
    						echo "school id: ";
    						echo $tb_education[$e]['school_id'] =  @$consulta_dados_pessoais_decoded_arr['education'][$e]['school']['id'];
    						echo "</BR>";
    						echo "school name: ";
    						echo $tb_education[$e]['school_name'] =  @$consulta_dados_pessoais_decoded_arr['education'][$e]['school']['name'];
    						echo "</BR>";
    						echo "year id";
    						echo $tb_education[$e]['year_id'] =  @$consulta_dados_pessoais_decoded_arr['education'][$e]['year']['id'];
    						echo "</BR>";
    						echo "year name";
    						echo $tb_education[$e]['year_name'] =  @$consulta_dados_pessoais_decoded_arr['education'][$e]['year']['name'];
    						echo "</BR>";
    						echo "type";
    						echo $tb_education[$e]['type'] =  @$consulta_dados_pessoais_decoded_arr['education'][$e]['type'];
    						
    						//quantidade de áreas de concentração
    						$tb_education[$e]['concentration_ids'] = "";
    						$tb_education[$e]['concentration_names'] = "";
    						for($concentration_education = 0; $concentration_education < sizeof(@$consulta_dados_pessoais_decoded_arr['education'][$e]['concentration']); $concentration_education++ )
    						{
    							if($concentration_education == 0)
    							{
    									$tb_education[$e]['concentration_ids'] = $tb_education[$e]['concentration_ids']."".@$consulta_dados_pessoais_decoded_arr['education'][$e]['concentration'][$concentration_education]['id'];
    									$tb_education[$e]['concentration_names'] = $tb_education[$e]['concentration_names']."".@$consulta_dados_pessoais_decoded_arr['education'][$e]['concentration'][$concentration_education]['name'];
    							}
    							else
    							{
    									$tb_education[$e]['concentration_ids'] = $tb_education[$e]['concentration_ids'].",".@$consulta_dados_pessoais_decoded_arr['education'][$e]['concentration'][$concentration_education]['id'];
    									$tb_education[$e]['concentration_names'] = $tb_education[$e]['concentration_names'].",".@$consulta_dados_pessoais_decoded_arr['education'][$e]['concentration'][$concentration_education]['name'];
    							}
    						}
    						echo "concentration_ids ".@$tb_education[$e]['concentration_ids'];
    						echo "</BR>";
    						echo "concentration_names ".@$tb_education[$e]['concentration_names'];
    						echo "</BR>";
    						
    						//quem a pessoa estudous
    						$tb_education[$e]['with_ids'] = "";
    						
    						for($people_education = 0; $people_education < sizeof(@$consulta_dados_pessoais_decoded_arr['education'][$e]['with']); $people_education++)
    						{
	    						if($people_education == 0)
	    						{
	    								$tb_education[$e]['with_ids'] = $tb_education[$e]['with_ids']."".@$consulta_dados_pessoais_decoded_arr['education'][$e]['with'][$people_education]['id'];
	    						}
	    						else
	    						{
										$tb_education[$e]['with_ids'] = $tb_education[$e]['with_ids'].",".@$consulta_dados_pessoais_decoded_arr['education'][$e]['with'][$people_education]['id'];
	    						}
    						}
    						echo "education with ids ".$tb_education[$e]['with_ids'];
    						echo "</BR>";  	

    						//colocar dados de $tb_education no banco de dados
    						$query_tb_education_fb_user = "INSERT INTO education_fb_user (uid, school_id, year_id, year_name, concentration_ids, concentration_names, with_ids) VALUES ($1, $2, $3, $4, $5, $6, $7)";
    						pg_prepare($conexao_localhost->con(), "", $query_tb_education_fb_user);
    						@pg_execute($conexao_localhost->con(), "", array($tb_user_uid, $tb_education[$e]['school_id'], $tb_education[$e]['year_id'], $tb_education[$e]['year_name'], $tb_education[$e]['concentration_ids'], $tb_education[$e]['concentration_names'], $tb_education[$e]['with_ids']));
    						
    						//atualizar dados da instuição de educação
    						@$query_tb_education = "INSERT INTO education (school_id, school_name, type) VALUES ($1, $2, $3)";
    						@pg_prepare($conexao_localhost->con(), "", $query_tb_education);
    						@pg_execute($conexao_localhost->con(), "", array($tb_education[$e]['school_id'], $tb_education[$e]['school_name'], $tb_education[$e]['type']));
    						
    				}
    				echo "user schools ids ".$tb_user_education_ids;
    				echo "</BR>";
    				
    				$tb_user_languages_ids = "";
    				$tb_user_languages_names = "";
    				for($qtd_lang = 0; $qtd_lang < sizeof($consulta_dados_pessoais_decoded_arr['languages']) ; $qtd_lang++)
    				{
    					if($qtd_lang == 0)
    					{
    						$tb_user_languages_ids = $tb_user_languages_ids."".@$consulta_dados_pessoais_decoded_arr['languages'][$qtd_lang]['id'];
    						$tb_user_languages_names = $tb_user_languages_names."".@$consulta_dados_pessoais_decoded_arr['languages'][$qtd_lang]['name'];
    					}
    					else 
    					{
    						$tb_user_languages_ids = $tb_user_languages_ids.",".@$consulta_dados_pessoais_decoded_arr['languages'][$qtd_lang]['id'];
    						$tb_user_languages_names = $tb_user_languages_names.",".@$consulta_dados_pessoais_decoded_arr['languages'][$qtd_lang]['name'];
    					}
    				}
    				echo "languages ids".$tb_user_languages_ids;
    				echo "</BR>";
    				echo "languages names".$tb_user_languages_names;
    				echo "</BR>";
    				echo "quantidade de amigos: ";
    				echo $tb_user_friend_count = @$consulta_dados_pessoais_decoded_arr['friend_count'];
    				echo "</BR>";
    				echo "mural com permissao de postagem";
    				echo $tb_user_can_post = "a".@$consulta_dados_pessoais_decoded_arr['can_post']."a";
    				if($tb_user_can_post == '1')
    				{
    					$tb_user_can_post = 1;//true
    				}
    				else{
    					$tb_user_can_post = 0;//false
    				}
    				echo "</BR>";
    				echo "</BR>";    	

    				//dados de education_fb_user e work_fb_user foram atualizados acima
		    		//colocar dados de $tb_user no banco de dados
		    		$query_tb_user = "INSERT INTO fb_user (uid, name, username, pic_square, profile_update_time, birthday_date, sex, hometown_location_id, relationship_status, significant_other_id, religion, political, activities, interests, current_location_id, is_app_user, quotes, about_me, wall_count, locale, profile_url, work_ids, education_ids, languages_ids, friend_count, can_post, languages_names) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24, $25, $26, $27)";
		    		pg_prepare($conexao_localhost->con(), "", $query_tb_user);
		    		pg_execute($conexao_localhost->con(), "", array($tb_user_uid, $tb_user_name, $tb_user_username, $tb_user_pic_square, $tb_user_profile_update_time, $tb_user_birthday_date, $tb_user_sex, $tb_user_hometown_location_id, $tb_user_relationship_status, $tb_user_significant_other_id, $tb_user_religion, $tb_user_political, $tb_user_activities, $tb_user_interests, $tb_user_current_location_id, $tb_user_is_app_user, $tb_user_quotes, $tb_user_about_me, $tb_user_wall_count, $tb_user_locale, $tb_user_profile_url, $tb_user_work_ids, $tb_user_education_ids, $tb_user_languages_ids, $tb_user_friend_count, $tb_user_can_post, $tb_user_languages_names));
		    		
		    		//inseri dados da cidade hometown
					@$query_tb_city = "INSERT INTO city (city_id, city_name, city_state, city_country) VALUES ($1, $2, $3, $4)";
		    		@pg_prepare($conexao_localhost->con(), "", $query_tb_city);
		    		@pg_execute($conexao_localhost->con(), "", array($tb_city_hometown_id, $tb_city_hometown_name, $tb_city_hometown_state, $tb_city_hometown_country));
		    		
		    		//inseri dados da cidade currenttown		    		
		    		@$query_tb_city = "INSERT INTO city (city_id, city_name, city_state, city_country) VALUES ($1, $2, $3, $4)";
		    		@pg_prepare($conexao_localhost->con(), "", $query_tb_city);
		    		@pg_execute($conexao_localhost->con(), "", array($tb_city_current_id, $tb_city_current_name, $tb_city_current_state, $tb_city_current_country));
		    		
		    		//dados da tabela mutualfriend
		    		$query_tb_mutual_friends = "INSERT INTO mutual_friends (uid1, uid2) VALUES ($1, $2)";
		    		pg_prepare($conexao_localhost->con(), "", $query_tb_mutual_friends);
		    		pg_execute($conexao_localhost->con(), "", array($uid1, $tb_user_uid));
		    		
    			}
    			$conexao_localhost->Close();
    			
    			
?>