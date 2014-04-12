<?php
#
# Projeto :  Lucato 
# Data : 10/02/2004
# 
# HTML para CONTROLE DE SESSÃO EM FRAME
#

    //*******************************************************************	
	// INCLUDES : AVISO!!!! respeitar a sequencia dos includes
    //*******************************************************************
	include "includes/library.php";
	include "includes/session.php";	
?>

<html>
<head>
<title>Gerenciador de Web Site</title>

<script language="JavaScript">
	var LeaveControl = 0; 

	function EncerraSessao(){
		if ( LeaveControl > 0 ) {
			window.open('user_logout.php?<?php echo show($sid_get)?>&apelido=<?php echo show(request("apelido"))?>',null, 'height=500,width=750,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,resizable=yes');
		}
	}

	</script>

</head>

<frameset framespacing="0" frameborder="0" border="no" cols="0,*" onunload="javascript:EncerraSessao();">
  <frame src="vazio.php" scrolling="no" marginwidth="0" marginheight="0"  noresize>
  <frame src="area_usuario.php?<?php echo show($sid_get)?>" scrolling="yes" marginwidth="0" marginheight="0" noresize>
  <noframes>
  </noframes>
</frameset>
</html>


