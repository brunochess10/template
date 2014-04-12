<html>
<head>
<title>Gerenciador - Neo Site Contábil</title>
<script type="text/javascript" src="scripts/common_scripts.js"></script>
<script type="text/javascript" src="scripts/robo_lookup.js"></script>
<script type="text/javascript" src="scripts/sortabletable.js"></script>
<script type="text/javascript" src="scripts/stringbuilder.js"></script>
<script type="text/javascript" src="scripts/numberksorttype.js"></script>
<script type="text/javascript" src="scripts/uscurrencysorttype.js"></script>
<!-- <script type="text/javascript" src="scripts/jscalendar/calendar.js"></script> -->
<script type="text/javascript" src="scripts/jscalendar/calendar-publi.js"></script>
<script type="text/javascript" src="scripts/jscalendar/lang/calendar-br.js"></script>
<script type="text/javascript" src="scripts/jscalendar/calendar-setup.js"></script>
<script type="text/javascript" src="scripts/jscalendar/calendar-setup.js"></script>
<script type="text/javascript" src="scripts/jquery-1.2.6.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="scripts/jscalendar/calendar-tas.css" title="win2k-cold-1" />

<script language="JavaScript">
	function encerrar() {
		if(typeof(parent.LeaveControl)=="number") {
			parent.LeaveControl = 0;
			document.location = "user_logout.php?<?php echo show($sid_get)?>&apelido=<?php echo show(request_session('EMP_APELIDO'))?>";
		}
		return false;
	}

	function set_query( form) {
		document.location = 'robo_pesquisa.php?<?php echo $sid_get?>&mod=' + form.mod.value + '&allwords=' + form.allwords.value + '&query=' + form.query.value + '&makesearch=yes';
		return false;
	}

</script>
<LINK REL="StyleSheet" HREF="css/neosite.css" type="text/css">
</head>
<body onload="javascript:CarregaBody();">
<!-- IFRAME UTILIZADO PARA LOOKUP -->
<iframe name="ifr_lookup" id="ifr_lookup_id" src="" width="0" height="0" frameborder="0" scrolling="no"></iframe>
<!-- IFRAME UTILIZADO PARA LOOKUP -->
