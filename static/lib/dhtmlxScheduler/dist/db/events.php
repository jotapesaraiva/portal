<?php
	require_once('../codebase/connector/scheduler_connector.php');
	include ('./config.php');

	$list = new OptionsConnector($res, $dbtype);
		/* //Teste para saber esta conectando.
	if($list){
		echo "Conexão Estabelecida!";
	}
	else{
		echo "Erro ao Conectar: " . $erro['message'];
	}
	*/
	//$list->render_table("types","typeid","typeid(value),name(label)");
	$list->render_table("SELECT DISTINCT specification value,
						  specification label	
			  FROM tbl_dp_backups
			  WHERE specification NOT LIKE '%TESTE%'
			  AND specification <> 'Interactive'
			  AND specification NOT LIKE '%OLD%'
			  AND specification NOT LIKE '%EXTRA%'
			  AND specification NOT LIKE '%DD'
			  AND specification NOT LIKE 'FRONT_%'
			  AND specification <> 'DEFAULT'
			  AND specification NOT LIKE '%\_0'
			  AND specification NOT LIKE '%\_1'
			  AND day_time between (NOW() - interval 1 month) and NOW()","specification","specification(value),specification(label)");
	
	$scheduler = new schedulerConnector($res, $dbtype);
		/* //Teste para saber esta conectando.
	if($scheduler){
		echo "Conexão Estabelecida!";
	}
	else{
		echo "Erro ao Conectar: " . $erro['message'];
	}
	*/
	$scheduler->set_options("backup_list", $list);
	//$scheduler->render_table("tevents","event_id","start_date,end_date,event_name,type");
	$scheduler->render_table("SELECT
														 id,
				                        specification AS text,
					  TIMESTAMP(day_time, start_time) AS start_date,
TIMESTAMP(TIMESTAMP(day_time, start_time),`duration`) AS end_date,
											 duration AS duracao,
												media AS media,
										   gb_written AS tamanho,
														 status,
														 mode,
														 queuing,
														 files,
														 session_id,
							                   'true' AS readonly
			 FROM tbl_dp_backups
			WHERE specification NOT LIKE '%TESTE%'
			  AND specification NOT LIKE '%OLD%'
			  AND specification NOT LIKE '%EXTRA%'
			  AND specification NOT LIKE '%DD'
			  AND specification <> 'Interactive'
			  AND specification <> 'DEFAULT'
			  AND specification <> 'FRONT_ITINGA_02'
			  AND specification <> 'FRONT_ITINGA_01'
			  AND specification NOT LIKE '%\_0'
			  AND specification NOT LIKE '%\_1'
			  AND day_time between (NOW() - interval 1 year) and NOW()","id","start_date,end_date,text,duracao,media,tamanho,status,mode,queuing,files,session_id,readonly");
?>