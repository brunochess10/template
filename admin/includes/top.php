<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador do Neo Site Contábil</title>
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
<script type="text/javascript" src="scripts/jquery-1.2.6.js"></script>
<!--<script type="text/javascript" src="scripts/jquery.printElement.js"></script>-->
<script type="text/javascript" src="scripts/jquery.simplePrint.js"></script>


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
<body onLoad="javascript:CarregaBody();">
<!-- IFRAME UTILIZADO PARA LOOKUP -->
<iframe name="ifr_lookup" id="ifr_lookup_id" src="" width="0" height="0" frameborder="0" scrolling="no"></iframe>
<!-- IFRAME UTILIZADO PARA LOOKUP -->
<table class="topo">
	<tr>
		<td height="90">
			<img src="images/logo_topo.gif" align="left" style="margin-top:14px;margin-left:3px;"/>
			<table class="usuario">
<?php if ( !empty($usuario) ){ ?>
	<tr>
		<th style="border-top:none;border-left:none;">Usuário</th>
		<td style="border-top:none;border-right:none;"><?php echo show($usuario)?></td>
	</tr>
<?
}
if ( !empty($usuario_nome)){
?>
	<tr>
		<th style="border-bottom:none;border-left:none;">Nome</th>
		<td style="border-bottom:none;border-right:none;"><?php echo show($usuario_nome)?></td>
	</tr>
<? } ?>
</table>

		</td>
	</tr>
	<tr>
		<td class="ttempresa" style="padding-top:5px;">
			Gerenciador do Neo Site Contábil
		</td>
	</tr>
</table>
<table class="moldura">
	<tr>
		<td>