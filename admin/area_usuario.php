<?php
#
# Projeto :  Lucato 
# Data : 10/02/2004
# 
# Area Usu�rio
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
		  <!--Conte�do In�cio-->
          <center>
<!--<img src="images/fundo_login2.jpg"/>-->
			</center>
		  <!--Conte�do Final-->
</div>		

<? include("includes/bottom_comum.php"); ?>

