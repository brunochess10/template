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
		include "includes/config.php";
		include "includes/htmlMimeMail.php";
		include "includes/permissao.php";
		include "includes/session.php";
		include "includes/modules.php";
		
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
			function conta(num){
				document.getElementById('contagem').innerHTML=num+ ' [e-mail(s) importado(s) com sucesso]';
			}
			function emails_inseridos(email){
				document.getElementById('emails_inseridos').innerHTML+=email+"<br/>" ;
			}
			function conta_excluidos(num){
				document.getElementById('excluidos').innerHTML=num+ ' [e-mail(s) desativados]';
			}
			function emails_excluidos(email){
				document.getElementById('emails_excluidos').innerHTML+=email+"<br/>" ;
			}
			function fecha_sin(){
				document.getElementById('sincronismo').style.display='none';
				document.getElementById('criacao').style.display='none';
			}
			$(document).ready(function(){
				$("#sincronizar").click(function(){
					$("#form_sincronizar").submit();
				})
			})
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
		<th class="centro">Importar e-mails do Net Contábil</th>
		<td rowspan="2" class="direito"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</thead>
</table>
<fieldset class="destaquefild" >
	<legend>Observações</legend>
		<b>Quando for efetuado o clique no botão de sincronizar, ele buscará todos os e-mails que estão cadastrados no Net Contábil, você poderá 
		sincronizar quantas vezes forem necessárias, caso exista algum e-mail de cliente que você desativou no Net Contábil
		quando você clicar no botão sincronizar e se o e-mail já estiver cadastrado para receber o boletim o mesmo será excluído
		da listagem, se você estiver com alguma dúvida por favor entre em contato com o suporte técnico da Neo Solutions 
		<a href="http://www.neosolutions.com.br" target="_blank">www.neosolutions.com.br</a>
		</b>
	<div id="tot_email_enviado">
		
	</div>
</fieldset>
<br/>
<br/>
			
<table class="formeditar">
	<tr>
		<td>
			<fieldset class="destaquefild">
			<legend>Importação</legend>
			<br/>
			<form action='robo_sincroniza.php' method='post' target='sincronizar_iframe' id="form_sincronizar">
				<b><input type="checkbox" value="1" name="importar_desativados">Marque este item se você quer importar todos os usuários do Net Contábil.(Até os desativados).
				<br><br>
				<b>Áreas em que o usuário será cadastrado, quando for clicado no botão sincronizar</b>:
				<br/>
				<br/>
				<?php
						$sql = "SELECT * FROM area_newsletter";
						$AREA = new QUERY($DATABASE,$sql);
						while ($AREA->NEXT()){
				?>
						<input type="checkbox" name="area[]" value="<?php echo $AREA->BYNAME('are_id')?>" checked /><?php echo $AREA->BYNAME('are_titulo')?><br/>
				<?php				
						}
				?>
				<input type="button" value="Sincronizar" class="botaofild" id="sincronizar">
			</form>
			
			<table style="display:none;margin-left:20px;"  id="tabela" border="0">
				<tr>
					<td id="contagem" width="400" style="font-size:12pt;">&nbsp;</td>		
					<td id="excluidos" width="400" style="font-size:12pt;">&nbsp;</td>
				</tr>
				<tr>
					<td id="emails_inseridos" style="font-size:12pt;border:solid 1px #000000">&nbsp;</td>
					<td id="emails_excluidos" style="font-size:12pt;color:#000000;">&nbsp;</td>
				</tr>
			</table>
			<div id='sincronismo'>
			<iframe name='sincronizar_iframe' style='display:none;width:700px;height:500px'></iframe>
			<br/>
		</td>
	</tr>
</table>

<div id="resultado"></div>
<? include("includes/bottom_comum.php"); ?>