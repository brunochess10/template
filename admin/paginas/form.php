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
    	
		$real_fields ="P.id, P.menu_pai, " .
					           "P.titulo_menu, P.titulo_pagina, P.texto";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_paginas P where P.". $modules["paginas"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select $real_fields from site_paginas P limit 0,1";
		}
		$PAGINA = new QUERY($DATABASE,$sql);	                
		$PAGINA->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "Código do item";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "menu_pai";
		$params_item[$index]["caption"] = "Categoria";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "1";
				$params_item[$index]["options"][$i]["caption"] = "Institucional";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "2";	
				$params_item[$index]["options"][$i]["caption"] = "Ferramentas";
				unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "titulo_menu";
		$params_item[$index]["caption"] = "Título do menu";
		$params_item[$index]["size"] = "15";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "titulo_pagina";
		$params_item[$index]["caption"] = "Título da Página";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "texto";
		$params_item[$index]["caption"] = "Texto";
		
		
		$inputs = get_inputs( $PAGINA, $params_item, $mode, $sufix_paginas_new, $sufix_paginas_old);
		
?>
<!--
<table class="formeditar" align="center">
	<tr>
		<td>
		<img src="images/upload.png" style="float:left;margin-left:5px;"/><br/><b style="font-family:Arial"><a href="#" onclick="abre_janela('robo_upload.php?net_id=<?php echo $net_id ?>', '', 'width=600,height=400,scroll=yes');">Gerador de Link para Download</a></b> 
		</td>
	</tr>
</table>
-->	
<table class="formeditar" align="center">
<col width="30%"/>
		<?php
			if ($mode=="insert"){
				$help = mount_help( $inputs[0]["help"] );
		?>
		<?php
			}
		?>
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
	$CKEditor->config['width'] = 600;
	$CKEditor->config['height'] = 200;
	$CKEditor->config['toolbar'] = array(array('Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','Image','Source','Table'));
	
	if ($mode=="detail"){
		$CKEditor->config['readOnly'] = true;
	}
	
	//Replace a textarea element with an id (or name) of "textarea_id".
	$CKEditor->replace("texto_paginas_nv_0");
?>