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
		
		$real_fields ="U.id,U.usuario, U.senha ";
					           

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_usuario U where U.". $modules["admin_usuarios"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_usuario U limit 0,1";
		}
		$USER = new QUERY($DATABASE,$sql);	                
		$USER->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "Código do usuario";
		$params_item[$index]["type"] = "HIDDEN";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usuario";
		$params_item[$index]["caption"] = "Usuário";
		$params_item[$index]["help"] = "Usuário para entrar na área administrativa do web site";
		$params_item[$index]["size"] = "20";
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "senha";
		$params_item[$index]["type"] = "PASSWORD";
		$params_item[$index]["help"] = "Senha para entrar na área administrativa do web site";
		$params_item[$index]["caption"] = "Senha *criptografada";
		$params_item[$index]["size"] = "20";
		if (($mode=="edit")||($mode=="detail")){
			$params_item[$index]["default"] = md5($USER->BYNAME("senha"));
		}
		
		
		$inputs = get_inputs( $USER, $params_item, $mode, $sufix_usuario_new, $sufix_usuario_old);
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
		
		for ( $i = 0; $i < count($inputs); $i++ ){
				$help = mount_help( $inputs[$i]["help"] );
				if ($inputs[$i]["caption"]!="Senha *criptografada"){
					echo "<tr><th with='150'>" .$inputs[$i]["caption"]. "</th>";
					echo "<td>$help</td><td>" .$inputs[$i]["input"]. "</td></tr>";
				}
		}
		
		if ($mode=="insert"){
			echo "<tr><th with='150'>Senha</th>";
			echo "<td>$help</td><td>" .$inputs[1]["input"]. "</td></tr>";
			echo "<tr><th with='150'>Confirmar senha</th>";
			echo "<td>$help</td><td><input type=\"password\" name=\"confirmar_senha\"></td></tr>";
			
		}
		
		if ($mode=="edit"){
			echo "<tr><th with='150'>Nova senha</th>";
			echo "<td>$help</td><td>" .$inputs[1]["input"]. "</td></tr>";
			echo "<tr><th with='150'>Confirmar senha</th>";
			echo "<td>$help</td><td><input type=\"password\" name=\"confirmar_senha\"></td></tr>";
			
		}
		
		
?>		
	
</table>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>