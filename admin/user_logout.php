<?
#
# Projeto :  Lucato 
# Data : 10/02/2004
# 
# LOGOUT
#

    //*******************************************************************
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************
	include "includes/library.php";

	include "includes/session.php";

    //*******************************************************************
	// SOURCE
    //*******************************************************************
	session_unset();
	session_destroy();

?>

<? include("includes/top.php"); ?>
<script type="text/javascript" src="scripts/user_logout.js"></script>
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
<center>
<div class="msgoff">
Sessão encerrada.
<a href="javascript:logar();">Clique aqui </a> para logar novamente. Obrigado!
</div>
</center>



<? include("includes/bottom_comum.php"); ?>

