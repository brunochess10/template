<?
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
	
	$lk_include = request("lk_include");

	if ( $lk_include == "common" ){
		include "includes/ibase_common.php";
	} else {
		//include "includes/ibase_empresa.php";
	}
	
	
	$lk_field = request("lk_field");
	$lk_value = request("lk_value");
	$lk_table = request("lk_table");
	$lk_field_result = stripslashes( request("lk_field_result") );

	$lk_input_id = request("lk_input_id");	
	
	
	$sql = "select $lk_field_result as RESULT from $lk_table where $lk_field = '$lk_value'";
	
	
	
		
	$LK = new QUERY($DB,$sql );
	if ( $LK->NEXT() ) {
			$result = $LK->BYNAME( "RESULT" );
	} else {
			$result = "registro inexistente";
	}
	$LK->FREE();
	$DB->CLOSE();
	
?>

<html>
<head>
		<script type="text/javascript">
				function onload_lookup(){
						var input_id = document.getElementById("input_id_id");
						var input_value = document.getElementById("result_id");
						window.parent.lookup_return( input_id.value, input_value.value )
				}
		</script>
</head>
<body onload="javascript:onload_lookup();">
<form name="frmlookup">
    <input type="hidden" name="result" id="result_id" value="<?php echo $result?>" />
    <input type="hidden" name="input_id" id="input_id_id" value="<?php echo $lk_input_id?>" />
</form>
</body>
</html>


