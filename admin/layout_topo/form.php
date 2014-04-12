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
    	
		$real_fields ="L.id, " .
					           "L.url, L.primeira_linha, L.segunda_linha, L.publicar";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_layout_topo L where L.". $modules["layout_topo"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_layout_topo L limit 0,1";
		}
		$LAYOUT = new QUERY($DATABASE,$sql);	                
		$LAYOUT->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "Código do item";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		/*$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "imagem";
		$params_item[$index]["caption"] = "Imagem do Topo";
		$params_item[$index]["size"] = "89";
		*/
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "url";
		$params_item[$index]["caption"] = "URL de acesso";
		$params_item[$index]["size"] = "89";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "primeira_linha";
		$params_item[$index]["caption"] = "Primeira Linha";
		$params_item[$index]["size"] = "40";
		$params_item[$index]["maxlegth"] = "37";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "segunda_linha";
		$params_item[$index]["caption"] = "Segunda Linha";
		$params_item[$index]["size"] = "40";
		$params_item[$index]["maxlegth"] = "18";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "publicar";
		$params_item[$index]["caption"] = "Publicar";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Publicar";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não Publicar";
				unset($i);
		
		$inputs = get_inputs( $LAYOUT, $params_item, $mode, $sufix_layout_new, $sufix_layout_old);
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
<?php
	//$caminho = explode("/",$_SERVER["SCRIPT_NAME"]);
	
	//for ($i=0;$i<count($caminho)-1;$i++){
	//	$path_ckeditor.=$caminho[$i]."/";
	//}
	
	include "ckeditor/ckeditor.php";
	// Create a class instance.
	$CKEditor = new CKEditor();
	// Path to the CKEditor directory.
	$CKEditor->basePath = "ckeditor/";
	$CKEditor->config['width'] = 800;
	$CKEditor->config['height'] = 300;
	$CKEditor->config['toolbar'] = array(array('Image'));
	$CKEditor->config['readOnly'] = true;
	//Replace a textarea element with an id (or name) of "textarea_id".
	$CKEditor->replace("imagem_layout_nv_0");
?>	