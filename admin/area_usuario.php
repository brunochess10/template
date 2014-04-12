<?php
#
# Projeto :  Lucato 
# Data : 10/02/2004
# 
# Area Usuário
#
    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";	
?>

<? include("includes/top_comum.php"); ?>
<script language="javascript">
	function LoadErrorsServidor() {
		<?php echo show($ERRORS)?>
		ShowListErrors();
	}
</script>
<script type="text/javascript" src="scripts/area_usuario.js"></script>
<!--<div style="background-color:#e95d0f;margin-bottom:-100px;">-->
		  <!--Conteúdo Início-->
          <center>
<!--<img src="images/fundo_login2.jpg"/>-->
			</center>
		  <!--Conteúdo Final-->
</div>		

<? include("includes/bottom_comum.php"); ?>

