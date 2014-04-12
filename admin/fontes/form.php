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
    	
		$real_fields ="M.ID, M.CONTAS_EM_REVISTA ";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_fontes_boletins M where M.". $modules["fontes"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_fontes_boletins M limit 0,1";
		}
		$FONTES = new QUERY($DATABASE,$sql);	                
		$FONTES->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ID";
		$params_item[$index]["caption"] = "Código da Midia";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "CONTAS_EM_REVISTA";
		$params_item[$index]["caption"] = "Ativar Contas em Revista. Esta ferramenta analisará todos os dias as 5 horas da manhã se existe uma notícia nova e incluirá no boletim.";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		
		$inputs = get_inputs( $FONTES, $params_item, $mode, $sufix_fontes_new, $sufix_fontes_old);
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
?>
</table>