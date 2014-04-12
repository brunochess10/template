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
		
		$real_fields ="M.mail_id, M.mail_data, " .
					           "M.mail_assunto, M.mail_corpo, M.mail_uniao";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from mail M where M.". $modules["boletins"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from mail M limit 0,1";
		}
		
		$MAIL = new QUERY($DATABASE,$sql);	                
		$MAIL->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "mail_id";
		$params_item[$index]["caption"] = "Código do item";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "mail_data";
		$params_item[$index]["caption"] = "Data";
		$params_item[$index]["type"] = "DATE";
		if ($mode=="insert") $params_item[$index]["default"] = date('d/m/Y');
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "mail_assunto";
		$params_item[$index]["caption"] = "Assunto";
		$params_item[$index]["size"] = "50";
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "mail_corpo";
		$params_item[$index]["caption"] = "Conteúdo";
		$params_item[$index]["type"] = "BLOB";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "mail_uniao";
		$params_item[$index]["caption"] = "Juntar com outras áreas";
		$params_item[$index]["type"] = "CHECKBOX";
		$params_item[$index]["checked_value"] = "T";
		
		
		$inputs = get_inputs( $MAIL, $params_item, $mode, $sufix_boletins_new, $sufix_boletins_old);
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
				if ($inputs[$i]["caption"]=="Juntar com outras áreas"){
					echo "<tr><th with='150'></th>";
					echo "<td>$help</td><td>Selecione as áreas abaixo:</td></tr>";
					//coloca opção para escolher as áreas
					$sql = "SELECT * FROM area_newsletter order by are_titulo";
					$AREA = new QUERY($DATABASE,$sql);
					while ($AREA->NEXT()){
						echo "<tr><th with='150'></th>";
						if (($mode=='edit')||($mode=='detail')){
							$sql = "SELECT * FROM area_mail WHERE arm_mail_id ='".$key."' AND arm_area_id ='".$AREA->BYNAME('are_id')."'";
							$VERIFICA= new QUERY($DATABASE,$sql);
							if ($VERIFICA->NEXT()){
								$marcado="checked";
							}else{
								$marcado="";
							}	
						}else{
							$marcado="checked";
						}	
						if ($mode=='detail'){
							$disabled = "disabled='disabled'";
						}
						echo "<td>$help</td><td><input type='checkbox' name='areas[]' value='".$AREA->BYNAME("are_id")."' $marcado $disabled>".$AREA->BYNAME("are_titulo")."</td></tr>";
					}
					echo "<tr><th with='150'></th>";
					echo "<td>$help</td><td>" .$inputs[$i]["input"]. " Se você quiser enviar o boletim para a os usuários que estão na intersecção de mais de uma área por favor cheque a opção ao lado, veja a imagem abaixo como exemplo, se você quiser enviar para os e-mails da que estão tanto na área A quanto na área B, você irá enviar e-mails para a área achurada <br/> <img src='images/intersecao.png' /></td></tr>";
				}else{
					echo "<tr><th with='150'>" .$inputs[$i]["caption"]. "</th>";
					echo "<td>$help</td><td>" .$inputs[$i]["input"]. "</td></tr>";
				}
				
		}
		
?>
</table>
	
<?php
	//echo "<pre>";
	//	print_r($_SERVER);
	//echo "</pre>";
	
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
	//$CKEditor->config['width'] = 600;
	$CKEditor->config['height'] = 800;
	$CKEditor->config['pasteFromWordRemoveFontStyles'] = false;
	$CKEditor->config['pasteFromWordRemoveStyles'] = false;
	//$CKEditor->config['uiColor'] = "#359ecd";
	//$CKEditor->config["filebrowserUploadUrl"] = "http://suporte.netcontabil.com.br/~bruno/template/site_v1/admin/ckeditor/ckupload.php";
	$CKEditor->config['toolbar'] = array(array('Image', 'Link', 'Unlink','Bold','Italic','Underline','FontSize','Font','TextColor','BGColor','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Source','Table'));
	if ($mode=="detail"){
		$CKEditor->config['readOnly'] = true;
	}
	
	//Replace a textarea element with an id (or name) of "textarea_id".
	$CKEditor->replace("mail_corpo_boletins_nv_0");
?>
<!--<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#mail_corpo_boletins_nv_0").ckeditor({
			<?php
				//if ($mode=="detail"){
			?>
				readOnly:true,
			<?php
				//}	
			?>
			toolbar:[['Image'],['Bold'],['FontSize']],
			width:600
		});
	})
</script>
-->
