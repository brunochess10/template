<?php
#
# Projeto :  Lucato 
# Data : 20/02/2004
# 
# ROBO Detalhe
#

    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";
 	include "includes/top_comum.php";
	
?>
	<script>
		function CarregaBody(){
			
		}
	</script>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro">Relatório de e-mails com falha no envio</th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>
<table class="formeditar" style="margin-left:10px;">
<tr>
	<td>
	<fieldset class="destaquefild">
	<legend>Relatório de e-mails com falha no envio</legend>	
	<div id="texto">
	<p>
	
	</p>
	<h1>Relatório de e-mails com falha no envio</h1>
	<?php
		$mail_id = request("mail_id");
		$sql = "SELECT L.*, M.usr_email FROM log_mail L inner JOIN mailing M on (L.mailing_id=M.usr_id) WHERE L.status='2' and L.mail_id='$mail_id'";
		$LOG = new QUERY($DATABASE,$sql);
	?>	
	<div id="atencao">
		<?php
			$sql="select * from mail where mail_id='$mail_id'";
			$TITULO = new QUERY($DATABASE,$sql);
			$TITULO->NEXT();
		?>	
		<h3>Boletim: <?php echo $TITULO->BYNAME("mail_assunto")?> </h3>
	
		*Atenção esse relatório signifa que o e-mail foi disparado, não significa que o seu cliente leu o e-mail!
	</div>
	<br>
	<table width="100%">
	<?php
		while ($LOG->NEXT()){
	?>
		<tr>
			<td width="10%"><?php echo $LOG->BYNAME("usr_email") ?></td>
			<td><img src="images/erro_email.png" width="10px" height="10px"></td>
			<td><?php echo $LOG->BYNAME("msg_erro") ?></td>
		</tr>
	<?php
		}
	?>	
	</table>
	<br>
	</fieldset>
	</div>
	</td>
</tr>
</table>	
</div>				
<br/>
<?php 	
include("includes/bottom_comum.php"); 
?>