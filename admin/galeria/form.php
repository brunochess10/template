<?php
#
# Params exemplo
# 0 o index, ou seja para o proximo campo coloque 1 e assim sucessivamente
# $params[0]["name"]  =  preencha com o nome do campo
# $params[0]["size"] = preencha com o tamanho do campo caso n�o queira aderir ao default calculado
# $params[0]["caption"] = preencha com o caption que vc quer que o ccampo apare�a o default o name do campo
# $params[0]["type"] = preencha com o tipo do campo
//tipos de campos
//$date = "TIMESTAMP";
//$currency = "DOUBLE";
//$integer = "LONG";
//$cep = "CEP";
//$select = "SELECT";
//$memo = "MEMO";
//$hidden = "HIDDEN";
# $params[0]["help"] = "ditige somente n�meros." // prenche com o help q vc desejar
//--------------------------------------------------------
//SOURCE
//--------------------------------------------------------
    	
		$real_fields ="G.ID, G.TITULO, " .
					           "G.ARQUIVO,G.PESO";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_galeria G where G.". $modules["galeria"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_galeria G limit 0,1";
		}
		$GALERIA = new QUERY($DATABASE,$sql);	                
		$GALERIA->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ID";
		$params_item[$index]["caption"] = "C�digo do item";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "TITULO";
		$params_item[$index]["caption"] = "T�tulo";
		$params_item[$index]["size"] = "80";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ARQUIVO";
		$params_item[$index]["caption"] = "Endere�o do Arquivo";
		$params_item[$index]["size"] = "255";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "PESO";
		$params_item[$index]["caption"] = "Ordem de apari��o, quanto maior o n�mero em primeiro aparecer�";
		$params_item[$index]["size"] = "20";
		
		$inputs = get_inputs( $GALERIA, $params_item, $mode, $sufix_galeria_new, $sufix_galeria_old);
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
	/*$caminho = explode("/",$_SERVER["SCRIPT_NAME"]);
	
	for ($i=0;$i<count($caminho)-1;$i++){
		$path_ckeditor.=$caminho[$i]."/";
	}
	*/
	include "ckeditor/ckeditor.php";
	// Create a class instance.
	$CKEditor = new CKEditor();
	// Path to the CKEditor directory.
	$CKEditor->basePath = "ckeditor/";
	$CKEditor->config['width'] = 600;
	$CKEditor->config['height'] = 200;
	$CKEditor->config['toolbar'] = array(array('Image'));
	if ($mode=="detail"){
		$CKEditor->config['readOnly'] = true;
	}
	
	//Replace a textarea element with an id (or name) of "textarea_id".
	$CKEditor->replace("ARQUIVO_galeria_nv_0");
?>