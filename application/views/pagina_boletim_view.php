<section class="conteudo">
<h1 class="title_boletim">{titulo_boletim}</h1>
{texto_boletim}     
<br/>
<br/>
<script>
$(document).ready(function(){
	$("#enviar_email").click(function(){
		var recomenda = $("#recomenda").val();
		$.ajax({
				type:"POST",
				url: "{site_url}admin/robo_envia_email_boletim.php",
				data:"teste="+recomenda+"&mail_id={mail_id}",
				success:function(mensagem){
						var teste_ok = $.trim(mensagem);
						//alert(teste_ok);
						if (teste_ok=="OK"){
							alert('Recomendação enviada!');
						}else{
							alert('Problema no envio do e-mail, tente mais tarde');
						}
						//$("#lightbox, #lightbox-panel").fadeOut(300);
				}
		});
		return false;
	});
})	
</script>
<form action="" onclick="return false;">
	E-mail: <input type="text" name="recomenda" id="recomenda" >
	<input type="submit" value="Recomendar" id="enviar_email" >
	<br>
	<br>
</form>
{facebook_comentario}

</section>