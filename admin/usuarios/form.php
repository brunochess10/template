<?php
#
# Params exemplo
# 0 o index, ou seja para o proximo campo coloque 1 e assim sucessivamente
# $params[0]["name"]  =  preencha com o nome do campo
# $params[0]["size"] = preencha com o tamanho do campo caso não queira aderir ao default calculado
# $params[0]["caption"] = preencha com o caption que vc quer que o ccampo apareça o default o name do campo
# $params[0]["type"] = preencha com o tipo do campo
//tipos de campos
//$date = "TIMESTAMP";
//$currency = "DOUBLE";
//$integer = "LONG";
//$cep = "CEP";
//$select = "SELECT";
//$memo = "MEMO";
//$hidden = "HIDDEN";
# $params[0]["help"] = "ditige somente números." // prenche com o help q vc desejar
//--------------------------------------------------------
//SOURCE
//--------------------------------------------------------
		
		$real_fields ="M.usr_id, M.usr_nome, " .
					           "M.usr_email, M.usr_data_cad, M.usr_hora_cad, M.usr_ip_cad, M.usr_status, M.usr_bounce";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from mailing M where M.". $modules["usuarios"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from mailing M limit 0,1";
		}
		$MAILING = new QUERY($DATABASE,$sql);	                
		$MAILING->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_id";
		$params_item[$index]["caption"] = "Código do usuario";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_data_cad";
		$params_item[$index]["caption"] = "Data de Cadastro";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		$params_item[$index]["default"] = date('Y-m-d');
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_hora_cad";
		$params_item[$index]["caption"] = "Hora cadastro";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		$params_item[$index]["default"] = date('H:m:s');
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_ip_cad";
		$params_item[$index]["caption"] = "IP Cadastro";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		$params_item[$index]["default"] = $_SERVER["REMOTE_ADDR"];
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_nome";
		$params_item[$index]["caption"] = "Nome";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_email";
		$params_item[$index]["caption"] = "E-mail";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_status";
		$params_item[$index]["type"] = "SELECT";
		$params_item[$index]["caption"] = "Ativo";
		$params_item[$index]["size"] = "50";
		$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usr_bounce";
		$params_item[$index]["caption"] = "Motivo para desativar";
		$params_item[$index]["size"] = "50";
		
		
		
		
		$inputs = get_inputs( $MAILING, $params_item, $mode, $sufix_usuario_new, $sufix_usuario_old);
?>

<table class="formeditar" align="center">
<col width="30%"/>
		<?php
			if ($mode=="insert"){
				$help = mount_help( $inputs[0]["help"] );
		?>
		<?php
			}
		?>
		<!-- FIXO se caso for consistir e der erro -->

<?php
		
		for( $i = 0; $i < count($inputs); $i++ ){
				$help = mount_help( $inputs[$i]["help"] );
				echo "<tr><th with='150'>" .$inputs[$i]["caption"]. "</th>";
				echo "<td>$help</td><td>" .$inputs[$i]["input"]. "</td></tr>";
		}
		
		//montar areas de interesse
		$sql = "SELECT * FROM area_newsletter";
		$AREA = new QUERY($DATABASE,$sql);
		while ($AREA->NEXT()){
			if ($mode=='insert'){
				echo "<tr><th with='150'></th>";
				echo "<td>$help</td><td><input type='checkbox' checked name='areas[]' value='".$AREA->BYNAME("are_id")."'>".$AREA->BYNAME("are_titulo")."</td></tr>";
			}else{
				$sql = "SELECT * FROM area_mailing where aru_mailing_id ='".$key."' AND aru_area_id='".$AREA->BYNAME("are_id")."'";
				$VERIFICA_MARCADO = new QUERY($DATABASE,$sql);
				if ($VERIFICA_MARCADO->NEXT()){
				//echo $sql."<br/>";
					$marcado = "checked";
				}else{
					$marcado = "";
				}
				if ($mode=='detail'){
					$disabled = "disabled='disabled'";
				}
				echo "<tr><th with='150'></th>";
				echo "<td>$help</td><td><input type='checkbox' $marcado $disabled name='areas[]' value='".$AREA->BYNAME("are_id")."' >".$AREA->BYNAME("are_titulo")."</td></tr>";
			}
		}
		
		
		
?>
</table>