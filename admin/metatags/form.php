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
		
		$real_fields ="M.id,M.id_pagina, M.url_nome, " .
					           "M.title, M.description, M.keyword";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_metatags M where M.". $modules["metatags"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_metatags M limit 0,1";
		}
		
		$META = new QUERY($DATABASE,$sql);	                
		$META->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "Código da metatag";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id_pagina";
		$params_item[$index]["caption"] = "Código da página metatag";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "url_nome";
		$params_item[$index]["caption"] = "Nome da página";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "title";
		$params_item[$index]["caption"] = "Título da página";
		$params_item[$index]["size"] = "40";
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "description";
		$params_item[$index]["caption"] = "Descrição da página no máximo 155 caracteres";
		$params_item[$index]["type"] = "TEXT";
		$params_item[$index]["size"] = "40";
		$params_item[$index]["maxlenght"] = "150";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "keyword";
		$params_item[$index]["caption"] = "Palavras-chaves, separe as palavras com uma vírgula Ex: contabilidade, irpf, etc. Aconselhamos a ter no máximo 20 palavras chaves";
		$params_item[$index]["type"] = "TEXT";
		$params_item[$index]["size"] = "40";
		
		$inputs = get_inputs( $META, $params_item, $mode, $sufix_meta_new, $sufix_meta_old);
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