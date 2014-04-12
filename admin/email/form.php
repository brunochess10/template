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
		
		$real_fields ="E.id,E.smtp_mail, E.smtp, " .
					           "E.porta, E.email, E.tipo_autenticacao, E.usuario, E.senha, E.dominio, E.intervalo , E.charset, E.gateway";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_email E where E.". $modules["email"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_email E limit 0,1";
		}
		$EMAIL = new QUERY($DATABASE,$sql);	                
		$EMAIL->NEXT();
		
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
		$params_item[$index]["name"] = "smtp_mail";
		$params_item[$index]["caption"] = "*Se voc� enviar autenticado atrav�s do SMTP utilize a op��o 'smtp'. <br> Se usar a pr�pria hospedagem (*Sendmail) para envio dos e-mails utilize 'mail' <br> <b>*Aten��o: Se nenhuma op��o estiver marcada por padr�o o envio � autenticado por smtp</b> ";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "smtp";
				$params_item[$index]["options"][$i]["caption"] = "smtp";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "mail";	
				$params_item[$index]["options"][$i]["caption"] = "mail";
				unset($i);
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "smtp";
		$params_item[$index]["caption"] = "SMTP";
		$params_item[$index]["help"] = "Verifique com a empresa que presta o servi�o de e-mail, qual � seu servidor SMTP";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "dominio";
		$params_item[$index]["help"] = "Coloque o dom�nio do seu web site, por exemplo seusite.com.br";
		$params_item[$index]["caption"] = "Dom�nio ex: (seusite.com.br)";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "porta";
		$params_item[$index]["help"] = "Geralmente as portas utilizadas s�o a 25 e 587, recomendamos o uso da porta 587";
		$params_item[$index]["caption"] = "Porta";
		$params_item[$index]["size"] = "4";
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "email";
		$params_item[$index]["help"] = "Digite o e-mail que aparecer� como remetente para o seu cliente";
		$params_item[$index]["caption"] = "E-mail";
		$params_item[$index]["size"] = "60";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "tipo_autenticacao";
		$params_item[$index]["help"] = "Se voc� estiver utilizando uma autentica��o segura digite TLS ou SSL";
		$params_item[$index]["caption"] = "Selecione o tipo de autentica��o SSL TLS ou deixe em Padr�o caso seja normal";
		$params_item[$index]["size"] = "4";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
				$params_item[$index]["options"][$i]["value"] = "";
				$params_item[$index]["options"][$i]["caption"] = "Padr�o";
				$i++;
     			$params_item[$index]["options"][$i]["value"] = "TLS";
				$params_item[$index]["options"][$i]["caption"] = "TLS";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "SSL";	
				$params_item[$index]["options"][$i]["caption"] = "SSL";
				unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "usuario";
		$params_item[$index]["help"] = "Digite o usu�rio que far� a autentica��o do envio do e-mail, geralmente � o e-mail completo";
		$params_item[$index]["caption"] = "Usu�rio";
		$params_item[$index]["size"] = "60";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "senha";
		$params_item[$index]["help"] = "Digite sua senha";
		$params_item[$index]["caption"] = "Senha";
		$params_item[$index]["size"] = "30";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "intervalo";
		$params_item[$index]["help"] = "Digite o intervalo entre um disparo e outro de e-mail, � sempre bom verificar qual � a pol�tica de disparo de e-mails da empresa que presta o servi�o de e-mail";
		$params_item[$index]["caption"] = "Intervalo em segudos do disparo";
		$params_item[$index]["size"] = "4";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "charset";
		$params_item[$index]["help"] = "Se voc� for utilizar um servi�o de disparo de e-mail personalizado digite utf-8, entre em contato com a Neo Solutions, pois voc� pode utilizar servidores de disparos de e-mail da Amazon a quantidade pode variar de acordo com o pacoteescolhido, caso contr�rio deixe esse campo em branco";
		$params_item[$index]["caption"] = "Charset (uft-8 ou ISO-8859-1) ou deixe em padr�o para normal";
		$params_item[$index]["size"] = "4";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
				$params_item[$index]["options"][$i]["value"] = "";
				$params_item[$index]["options"][$i]["caption"] = "Padr�o";
				$i++;
     			$params_item[$index]["options"][$i]["value"] = "uft-8";
				$params_item[$index]["options"][$i]["caption"] = "uft-8";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "ISO-8859-1";	
				$params_item[$index]["options"][$i]["caption"] = "ISO-8859-1";
				unset($i);
				
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "gateway";
		$params_item[$index]["help"] = "Utilizar gateway para disparar o e-mail";
		$params_item[$index]["caption"] = "Utilizar gateway para disparar o e-mail, por padr�o n�o usa gateway";
		$params_item[$index]["size"] = "4";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
				$params_item[$index]["options"][$i]["value"] = "";
				$params_item[$index]["options"][$i]["caption"] = "Padr�o";
				$i++;
     			$params_item[$index]["options"][$i]["value"] = "true";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "false";	
				$params_item[$index]["options"][$i]["caption"] = "N�o";
				unset($i);
		
		$inputs = get_inputs($EMAIL, $params_item, $mode, $sufix_email_new, $sufix_email_old);
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