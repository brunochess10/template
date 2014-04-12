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
		
		$real_fields ="E.id, E.data, " .
					           "E.titulo, E.texto, E.publicar";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_aviso E where E.". $modules["avisos"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_aviso E limit 0,1";
		}
		$BANNER = new QUERY($DATABASE,$sql);	                
		$BANNER->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "C�digo do item";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "data";
		$params_item[$index]["caption"] = "Data";
		$params_item[$index]["type"] = "DATE";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "titulo";
		$params_item[$index]["caption"] = "T�tulo";
		$params_item[$index]["size"] = "89";
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "texto";
		$params_item[$index]["caption"] = "Texto";
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "publicar";
		$params_item[$index]["caption"] = "Publicar";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "N�o";
		unset($i);
		$inputs = get_inputs( $BANNER, $params_item, $mode, $sufix_avisos_new, $sufix_avisos_old);
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

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#TEXTO_avisos_nv_0").ckeditor({
			<?php
				if ($mode=="detail"){
			?>
			readOnly:true,
			<?php
				}	
			?>
			toolbar:
			[
				['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','Image'],
				['UIColor']
			],
			width:470
		});
	})
</script>