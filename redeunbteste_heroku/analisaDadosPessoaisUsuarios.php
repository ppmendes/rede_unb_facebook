<?php 		
/*
 *  Arquivo que analisa os dados pessoais coletados, os decomp�e e grava no banco de dados
 *  @author Pedro Paulo Mendes Pereira
 */

				include_once 'config/conexao.inc';
				$conexao = new Conexao();
				$conexao->Open();
				
				$query_consulta_dados_pessoais = "SELECT objects_personaldata_user_userfriends FROM objects_user limit 1";
				pg_prepare($conexao->con(), "", $query_consulta_dados_pessoais);
				$consulta_dados_pessoais = pg_execute($conexao->con(), "", array($UsuarioFanPagesVarDump));
				var_dump($consulta_dados_pessoais);
				$conexao->Close();
				exit;
				$row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
				$id_romaneio = $row['id_romaneio'];
				
				
				//analisando e tratando as informações de cada usuário
    			for($k = 0; $k < sizeof($dadosAmigos); $k++)
    			{
    				$tb_user_uid = $dadosAmigos[$k]['uid'];
    				$tb_user_name = $dadosAmigos[$k]['name'];
    				$tb_user_username = $dadosAmigos[$k]['username'];
    				$tb_user_pic_square = $dadosAmigos[$k]['pic_square'];
    				$tb_user_profile_update_time = $dadosAmigos[$k]['profile_update_time'];
    				$tb_user_birthday_date = $dadosAmigos[$k]['birthday_date'];
    				$tb_user_sex = $dadosAmigos[$k]['sex'];
    				//verificar
    				$tb_user_hometown_location_id = $dadosAmigos[$k]['hometown_location']['id'];
    				$tb_user_relationship_status = $dadosAmigos[$k]['relationship_status'];
    				$tb_user_significant_other_id = $dadosAmigos[$k]['significant_other_id'];
    				$tb_user_religion = $dadosAmigos[$k]['religion'];
    				$tb_user_political = $dadosAmigos[$k]['political'];
    				$tb_user_activities = $dadosAmigos[$k]['activities'];
    				$tb_user_current_location_id = $dadosAmigos[$k]['current_location']['id'];
    				$tb_user_is_app_user =  $dadosAmigos[$k]['is_app_user'];
    				$tb_user_quotes =  $dadosAmigos[$k]['quotes'];
    				$tb_user_about_me =  $dadosAmigos[$k]['aboute_me'];
    				$tb_user_wall_count =  $dadosAmigos[$k]['wall_count'];
    				$tb_user_locale =  $dadosAmigos[$k]['locale'];
    				$tb_user_profile_url =  $dadosAmigos[$k]['profile_url'];

    				//work que será gravado no banco separado por vírgula
    				$tb_user_work_ids = "";
    				for($w = 0; $w < sizeof($dadosAmigos[$k]['work']); $w++)
    				{
    					if($w == 0)
    					{
    						$tb_user_work_ids += $dadosAmigos[$k]['work'][$w]['id'];
    						
    					}
    					else
    					{
    						$tb_user_work_ids += ",".$dadosAmigos[$k]['work'][$w]['id'];
    					}
    					
    					$tb_work[$w]['employer_id'] =  $dadosAmigos[$k]['work'][$w]['employer']['id'];
    					$tb_work[$w]['employer_name'] =  $dadosAmigos[$k]['work'][$w]['employer']['name'];
    					$tb_work[$w]['location_id'] =  $dadosAmigos[$k]['work'][$w]['location']['id'];
    					$tb_work[$w]['location_name'] =  $dadosAmigos[$k]['work'][$w]['location']['name'];
    					$tb_work[$w]['position_id'] =  $dadosAmigos[$k]['work'][$w]['position']['id'];
    					$tb_work[$w]['position_name'] = $dadosAmigos[$k]['work'][$w]['position']['name'];

    					//quem a pessoa trabalhou
    					$tb_work[$w]['with_ids'] = "";    					
    					for($people_work = 0; $people_work = sizeof($dadosAmigos[$k]['work'][$w]['with']); $people_work++)
    					{
    						if($people_work == 0)
    						{
    						$tb_work[$w]['with_ids'] += $dadosAmigos[$k]['work'][$w]['with'][$people_work]['id'];
    						}
    						else
    						{
    						$tb_work[$w]['with_ids'] += ",".$dadosAmigos[$k]['work'][$w]['with'][$people_work]['id'];
    						}
    							
    					}
    					
    				}
    				
    				//education que será gravado no banco separado por vírgula
    				$tb_user_education_ids = "";
    				for($e = 0; $e < sizeof($dadosAmigos[$k]['education']); $e++)
    				{
	    					if($e == 0)
	    					{
	    						$tb_user_education_ids += $dadosAmigos[$k]['education'][$e]['id'];
    						}
    						else
    						{
    							$tb_user_education_ids += ",".$dadosAmigos[$k]['education'][$e]['id'];
    						}
    						
    						$tb_education[$e]['school_id'] =  $dadosAmigos[$k]['education'][$e]['employer']['id'];
    						$tb_education[$e]['school_name'] =  $dadosAmigos[$k]['education'][$e]['employer']['name'];
    						$tb_education[$e]['year_id'] =  $dadosAmigos[$k]['education'][$e]['location']['id'];
    						$tb_education[$e]['year_name'] =  $dadosAmigos[$k]['education'][$e]['location']['name'];
    						$tb_education[$e]['type'] =  $dadosAmigos[$k]['education'][$e]['position']['id'];
    						
    						//quantidade de áreas de concentração
    						$tb_education[$e]['concentration_ids'] = "";
    						$tb_education[$e]['concentration_names'] = "";
    						for($concentration_education = 0; $concentration_education < sizeof($dadosAmigos[$k]['education'][$e]['concentration']); $concentration_education++ )
    						{
    							if($concentration_education == 0)
    							{
    								$tb_education[$e]['concentration_ids'] += $dadosAmigos[$k]['education'][$e]['concentration'][$concentration_education]['id'];
    								$tb_education[$e]['concentration_names'] += $dadosAmigos[$k]['education'][$e]['concentration'][$concentration_education]['name'];
    							}
    							else
    							{
    								$tb_education[$e]['concentration_ids'] += ",".$dadosAmigos[$k]['education'][$e]['concentration'][$concentration_education]['id'];
    								$tb_education[$e]['concentration_names'] += ",".$dadosAmigos[$k]['education'][$e]['concentration'][$concentration_education]['name'];
    							}
    						}
    						
    						//quem a pessoa estudous
    						$tb_education[$e]['with_ids'] = "";
    						for($people_education = 0; $people_education = sizeof($dadosAmigos[$k]['education'][$e]['with']); $people_education++)
    						{
	    						if($people_education == 0)
	    						{
	    							$tb_education[$e]['with_ids'] += $dadosAmigos[$k]['education'][$e]['with'][$people_education]['id'];
	    						}
	    						else
	    						{
	    							$tb_education[$e]['with_ids'] += ",".$dadosAmigos[$k]['education'][$e]['with'][$people_education]['id'];
	    						}
    						}
    						
    				}
    				$tb_user_languages_ids = "";
    				$tb_user_languages_names = "";
    				for($qtd_lang = 0; $qtd_lang < sizeof($dadosAmigos[$k]['languages']) ; $qtd_lang++)
    				{
    					$tb_user_languages_ids = "";
    					$tb_user_languages_names = "";
    					if($qtd_lang == 0)
    					{
    						$tb_user_languages_ids += $dadosAmigos[$k]['languages'][$qtd_lang]['id'];
    						$tb_user_languages_names += $dadosAmigos[$k]['languages'][$qtd_lang]['name'];
    					}
    					else 
    					{
    						$tb_user_languages_ids += ",".$dadosAmigos[$k]['languages'][$qtd_lang]['id'];
    						$tb_user_languages_names += ",".$dadosAmigos[$k]['languages'][$qtd_lang]['name'];
    					}
    				}
    				
    				$tb_user_friend_count = $dadosAmigos[$k]['friend_count'];
    				$tb_user_can_post = $dadosAmigos[$k]['can_post'];
    				
    			}
    			
    			$conexao->Close();
?>