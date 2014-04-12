<?
#
# Projeto :  Lucato 
# Data : 14/04/2004
# 
# Comentário do advogado sobre o andamento do processo
#

    //*******************************************************************	
	// INCLUDES nao alterar a ordem dos includes
    //*******************************************************************	
	include "includes/library.php";
	include "includes/session.php";

	//--------------------------------------------------------
	//SOURCE
	//--------------------------------------------------------
	$mod = request("mod");
	$key = request("key");	

			if ( $modules[$mod]["include"] ) {
					include $modules[$mod]["include"];
			}
	
	include("includes/top_comum.php");

?>

	<script language="JavaScript">
			function CarregaBody(){
			}
	</script>
	<table class="titulo">
	<thead>
		<tr>
			<td rowspan="2" class="esquerdo"></td>
			<th class="centro"> <?php echo $modules[$mod]["delete_titulo"] ?> </th>
			<td rowspan="2" class="direito"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</thead>
	</table>

				<?
						$url = urlencode( request("url") );
						if ( empty($url) ){		
								$url = "area_usuario.php?$sid_get";
								$url = urlencode( $url );
						} 
				?>
	
				<table class="resultado" align="center">
				<tbody>
					<tr>
						<td style="width:100%;">Deseja realmente excluír este registro? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" value="Sim" onclick="javascript:this.disabled = 'disabled';document.location='robo_apagar.php?<?php echo $sid_get?>&mod=<?php echo $mod?>&key=<?php echo $key?>&url=<?php echo $url?>'">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" value="Não" onclick="javascript:this.disabled = 'disabled';document.location='robo_detalhe.php?<?php echo $sid_get?>&mod=<?php echo $mod?>&key=<?php echo $key?>'"> 
					</tr>
				</tbody>	
				</table>

<? 	include("includes/bottom_comum.php"); ?>

