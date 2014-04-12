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
    	
		$real_fields ="M.id, M.user_facebook_id,M.url_fan_page," .
					           "M.ativar_facebook_comentario,M.ativar_curtir_facebook, M.user_twitter_id, M.ativar_twitter_posts, M.ativar_seguir_twitter ";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_midias M where M.". $modules["midias_sociais"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_midias M limit 0,1";
		}
		$MIDIAS = new QUERY($DATABASE,$sql);	                
		$MIDIAS->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "Código da Midia";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "url_fan_page";
		$params_item[$index]["caption"] = "URL da sua Fan Page no Facebook";
		$params_item[$index]["help"] = "Se você preencher este campo o curtir na sua página irá curtir a sua Fan Page";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "user_facebook_id";
		$params_item[$index]["caption"] = "Usuário do Facebook";
		$params_item[$index]["size"] = "30";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ativar_facebook_comentario";
		$params_item[$index]["caption"] = "Ativar Comentário Facebook";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ativar_curtir_facebook";
		$params_item[$index]["caption"] = "Ativar Botão Curtir do Facebook no site";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "user_twitter_id";
		$params_item[$index]["caption"] = "Usuário do Twitter";
		$params_item[$index]["size"] = "30";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ativar_twitter_posts";
		$params_item[$index]["caption"] = "Ativar Posts do Twitter";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ativar_seguir_twitter";
		$params_item[$index]["caption"] = "Ativar Seguir do Twitter";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		
		
		$inputs = get_inputs( $MIDIAS, $params_item, $mode, $sufix_midias_new, $sufix_midias_old);
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
		<input type="hidden" name="id_cliente" value="<?php echo $id_cliente;?>" />
<?php
		for( $i = 0; $i < count($inputs); $i++ ){
				$help = mount_help( $inputs[$i]["help"] );
				echo "<tr><th with='150'>" .$inputs[$i]["caption"]. "</th>";
				echo "<td>$help</td><td>" .$inputs[$i]["input"]. "</td></tr>";
		}
?>
</table>