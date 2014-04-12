<?
#
# Projeto :  Lucato 
# Data : 10/02/2004
# 
# Sessao expirada
#

    //*******************************************************************	
	// INCLUDES : AVISO!!!! respeitar a sequencia dos includes
    //*******************************************************************
	include "includes/library.php";
?>

<? include("includes/top.php"); ?>

<script language="JavaScript">
	function logar() {

			if(typeof(parent.LeaveControl)=="number") {
				parent.LeaveControl = 0;
				parent.document.location = "user_login.php?apelido=<?php echo show(request('apelido'))?>";
			} else {
			 	document.location = "user_login.php?apelido=<?php echo show(request('apelido'))?>";
			}
	}
</script>
<script type="text/javascript" src="scripts/session_expired.js"></script>
<center>
<div class="msgoff">
Sua sessão foi expirada. 
<a href="javascript:logar();">Clique aqui </a> para logar novamente. Obrigado!
</div>
</center>
  

<? include("includes/bottom_comum.php"); ?>



