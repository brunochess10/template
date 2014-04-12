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
<html>
	<head>
		<title></title>
	    <meta http-equiv="refresh" content="120">
	</head>
<body>
<?php	
	$agora = time();
	set_session("last_access",$agora);
	echo date("H:i:s", time());
?>			
</body>	
</html>
