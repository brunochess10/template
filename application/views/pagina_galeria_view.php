<section class="conteudo">
            <h1 class="title_home">Galeria de Fotos</h1>
			<br/>
			Clique em cima do título da foto para ver a Galeria de Imagens da Empresa
			<br/>
			<br/>
			{galeria}
				<a class="grouped_elements" rel="group1" href="{ARQUIVO}">{TITULO}</a>
				
				<br/><br/>
			{/galeria}
</section>
<script>
	$("a.grouped_elements").fancybox();
</script>