<?php
#
# Projeto :  Novo Neo Site Contábil
# 
# ROBO pesquisa
#
		//*******************************************************************
		// INCLUDES nao alterar a ordem dos includes
		//*******************************************************************
		// INCLUDES SEPARADOS PARA TER A OPÇÃO DE MUDAR O WHERE
		// DA PESQUISA DE ACORDO COM O NIVEL DO USUARIO
		include "includes/functions.php";
		include "includes/database.php";
		include "includes/htmlMimeMail.php";
		include "includes/permissao.php";
		include "includes/session.php";
		include "includes/modules.php";
		include "includes/config.php";
		
/*		
		include "includes/functions.php";
		include "includes/session.php";
		include "includes/config.php";
		include "includes/database.php";
		include "includes/htmlMimeMail.php";
		include "includes/modules.php";
		include "includes/permissao.php";
*/		

		//armazernar o link para o botao cancelar das telas
		$last_url = $_SERVER["PHP_SELF"] . "?" .$_SERVER["QUERY_STRING"];
		set_session("LAST_URL", $last_url);

		// começa a imprimir a tela
		include("includes/top_comum.php");
 		// Arquivo javascript com as consistencias da tela e o que precisar de java script
		//----------------------------------------------------------------------------------------------
?>
	<script language="JavaScript">
			function CarregaBody(){
			}
	</script>
<style>	
#lightbox {
 display:none;
 background:#000000;
 opacity:0.9;
 filter:alpha(opacity=90);
 position:absolute;
 top:0px;
 left:0px;
 min-width:100%;
 min-height:100%;
 z-index:1000;
}
#lightbox-panel {
 display:none;
 position:fixed;
 top:100px;
 left:50%;
 margin-left:-200px;
 filter:alpha(opacity=100);
 width:400px;
 background:#FFFFFF;
 padding:10px 15px 10px 15px;
 border:2px solid #CCCCCC;
 z-index:1001;
}
</style>
<div id="lightbox"> </div>
<div id="lightbox-panel"><center> <img src="images/carregando.gif" /> </center>  </div>


<table class="titulo">
<thead>
	<tr>
		<td rowspan="2" class="esquerdo"></td>
		<th class="centro">ENVIAR BOLETIM</th>
		<td rowspan="2" class="direito"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</thead>
</table>
<fieldset class="destaquefild" style="display:none;" id="enviar_boletim">
	<legend>Andamento do disparo</legend>
	<div id="espera">
		<b>Aguarde enquanto o envio do e-mail é processado...</b>
	</div>
	<div id="tot_email_enviado">
		
	</div>
</fieldset>
<br/>
<br/>
			<?php
				//recupera qual é o boletim
				$mail_id = request("key");
			?>
<table class="formeditar">
	<tr>
		<td>
			<fieldset class="destaquefild">
			<legend>BOLETINS</legend>
			*Atenção: O disparo entre um e-mail e outro é definido por padrão em 30 segundos, é muito importarte você verificar qual é a política 
			de envio de e-mails da empresa que fornece esse serviço para vocês, também é de extrema importância ter a configuração do e-mail pronta
			feita em "Configurar serviço de e-mail", neste local você deve colocar o usuário e a senha correta da conta de e-mail que fará os disparos.	
			<form>
				<input type="text" name="teste" id="teste" size="40" >
				<input type="button" value="Enviar Teste" class="botaofild" id="enviar_teste">
			</form>
			<br/>
			<input type="button" value="Enviar e-mail agora" class="botaofild" id="disparar_email"><br/><br/>
			<!--<input type="button" value="Agendar envio do boletim" class="botaofild" id="agendar_email"><br/>-->
			
			<div id="email" style="display:block;">
				<?php
					$sql = "SELECT * FROM log_mail WHERE mail_id = '$mail_id'";
					$USERS = new QUERY($DATABASE,$sql);
					
					$sql = "SELECT * FROM log_mail WHERE status <> '0' and mail_id = '$mail_id' ";
					$NAO_ENVIADO = new QUERY($DATABASE,$sql);
				?>
			</div>
			</div>
			</fieldset>
		</td>
	</tr>	
</table>
<?php
	$sql = "SELECT * FROM site_email ";
	$TEMPO = new QUERY($DATABASE,$sql);
	$TEMPO->NEXT();
	$delay = $TEMPO->BYNAME('intervalo');
	$delay++;
?>
<script>
	var total_email_disparo = <?php echo $USERS->NUMROWS(); ?>	
	var sSecs = <?php echo $delay ?>;
	var email_array;
	var indice = <?php echo $NAO_ENVIADO->NUMROWS(); ?>;
	var total_email =0;
	var diferenca=0;
	
	function getSecs(){
		sSecs--;
		$("#espera").html("Segundos para o próximo disparo:" + sSecs);
		$("#tot_email_enviado").html("Foram disparado(s) "+indice+" de "+total_email_disparo);
		if (sSecs==0){
			/*
			alert(email_array[indice]);
			disparar e-mail
			disparar e-mail
			*/
			$.ajax({
					type: "POST",
					url:"robo_envia_email_boletim.php",
					data:"email="+indice+"&mail_id=<?php echo $mail_id ?>",
					success:function(mensagem){
						//alert(mensagem);
					}
			});
			sSecs = <?php echo $delay ?>;
			if (indice!=total_email_disparo){
				indice++;
				setTimeout('getSecs()',1000);
			}else{
				$("#espera").hide();
				$("#tot_email_enviado").html("Foram disparado(s) "+indice+" de "+total_email_disparo);
				//enviar dado para avisar que todos os e-mails foram disparados com sucesso	
				$.ajax({
					type: "POST",
					url:"robo_envia_email_boletim.php",
					data:"final=<?php echo $mail_id ?>",
					success:function(mensagem){
						//alert(mensagem);
					}
				});
			}
		}else{ 
			setTimeout('getSecs()',1000);
		}
	}
	
	var visualiza=0;
	$("#visualizar_disparo").click(function(){
		if (visualiza==0){	
			$("#mostrar_emails").show();
			visualiza=1;
		}else{
			$("#mostrar_emails").hide();
			visualiza=0;
		}	
	});
	
	$("#disparar_email").click(function(){
		$("#enviar_boletim").show();
		setTimeout('getSecs()',1000);
	});	
	
	/**********************************************
	 * Enviar e-mail teste
	 **********************************************/
	
	$("#enviar_teste").click(function(){
		$("#lightbox, #lightbox-panel").fadeIn(300);
		var teste = $("#teste").val();
		$.ajax({
				type: "POST",
				url:"robo_envia_email_boletim.php",
				data:"teste="+teste+"&mail_id=<?php echo $mail_id ?>",
				success:function(mensagem){
						var teste_ok = $.trim(mensagem);
						//alert(teste_ok);
						if (teste_ok=="OK"){
							$("#lightbox-panel").html("<img src='images/fechar.png' style='float:right;'><h2>Mensagem enviada com sucesso <img src='images/certo.png' /></h2>");
						}else{
							$("#lightbox-panel").html("<img src='images/fechar.png' style='float:right;'><h2>Ocorreu um erro no envio <img src='images/erro.png' /></h2>");
						}
						//$("#lightbox, #lightbox-panel").fadeOut(300);
				}
		});
	});
	
	$("#lightbox").click(function(){
		$("#lightbox, #lightbox-panel").fadeOut(300);
	})
	
	$("#lightbox-panel").click(function(){
		$("#lightbox, #lightbox-panel").fadeOut(300);
	})
</script>
<div id="resultado"></div>
<? include("includes/bottom_comum.php"); ?>