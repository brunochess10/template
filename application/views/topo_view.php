<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="iso-8859-1"/> 
        <meta name="author" content="Neo Solutions - Soluções para escritórios contábeis">
        <meta name="robots" content="all">
        <title>{titulo_site}</title>
		<link href="{base_url}jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <link rel="stylesheet" href="{base_url}css/neosite.css">
        <link rel="stylesheet" href="{base_url}css/azul.css">
		<style>
		{css_cor}
        {logotipo}
        {pqec}
		</style>
		{google_analytics}
		{description}
		{keyword}
        <link rel="shortcut icon" href="favicon.ico">

        <!--[if IE 6]>
        <link href="css/neo_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <!--[if IE]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        {apresentacao_topo}
        <script type="text/javascript" src="{base_url}scripts/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="{base_url}scripts/menu.js"></script>
        <script type="text/javascript" src="{base_url}scripts/script.js"></script>
        <script type="text/javascript" src="{base_url}scripts/scripttransition.js"></script>
        <script type="text/javascript" src="{base_url}scripts/jquery.maskedinput-1.2.2.js"></script>
		<script type="text/javascript" src="{base_url}scripts/jquery.price_format.1.3.js"></script>
		<script type="text/javascript" src="{base_url}fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="{base_url}fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="{base_url}fancybox/jquery.fancybox-1.3.4.css" media="screen" />
		<script src='{base_url}jquery-ui/js/jquery-ui-1.10.3.custom.js'></script>
        <script>
              $(document).ready(function(){
                  $("#institucional_pai").mouseover(function(){
                       $("#institucional_filho").show()
                  })
                  $("#institucional_pai").mouseout(function(){
                       $("#institucional_filho").hide()
                  })
                  $("#ferramenta_pai").mouseover(function(){
                       $("#ferramenta_filho").show()
                  })
                  $("#ferramenta_pai").mouseout(function(){
                       $("#ferramenta_filho").hide()
                  })
                  
                  //efeito lightbox dos usuários
                  $("#botao_boletim").fancybox({
				  'titlePosition': 'inside',
				  'transitionIn' : 'none',
				  'transitionOut': 'none'
                  })
                  
                  //pega os dados e faz uma consistência
                  $("#confirmar").click(function(){
                      $("#email_boletim").val($("#email_temp").val())
                      $("#nome").val($("#nome_temp").val())
                      $("#form_cadastro").submit()
                  })
				})
        </script>    
    </head>
    <body>
        <div class="camada1">
            <header>
                <div id="headerimg1" class="headerimg"></div> 
                <div id="headerimg2" class="headerimg"></div> 
                <div class="skin">
                    <div class="arearestrita">
				        <form action="{endereco_seguro}/netcontabil/net_login.php" target="_blank" method="post" id="login_netcontabil">
                            Área Restrita <label>Usuário:</label><input  class="campos" type="text" name="usuario"> Senha:<input class="campos" type="password" name="senha" maxlength="10"><input value="entrar" type="button" onclick="loginnetcontabil();">
                        </form>
                    </div>

                    <div class="logo"></div>
                    <div class="pqec"></div> 
                    <div class="frases">
                        <span id="firstline"></span><br/> 
                        <a href="#" id="secondline"></a> 
                    </div>
						
                    <nav>
                        <ul> 
                            <li><a href="{site_url}home/" class="top_parent">Principal</a></li> 
                        </ul> 
						<?php if ($visualizar_pagina_institucional!="N") { ?>
                        <ul> 
                            <li id="institucional_pai"><a href="#" class="top_parent">Institucional</a> 
                                <ul id="institucional_filho" style="display:none"> 
                                    <?php if ($visualizar_pagina_institucional_empresa!="N") {?><li><a href="{site_url}empresa/">Empresa</a></li><?php } ?>
                                    <?php if ($visualizar_pagina_institucional_servicos!="N") { ?><li><a href="{site_url}servico/">Serviços</a></li><?php } ?>
                                    {institucional}
                                    <li><a href="{site_url}paginas/texto/{id}/{url_amigavel}">{titulo_menu}</a></li>
                                    {/institucional}
									<?php if ($visualizar_pagina_galeria_fotos=="S") { ?> <li><a href="{site_url}galeria/">Galeria de Fotos</a></li><?php } ?>
                                </ul> 
                            </li> 
                        </ul> 
						<?php
						}
						?>
						<?php if ($visualizar_pagina_boletins!="N") {?>
                        <ul> 
                            <li><a href="{site_url}boletim/lista" class="top_parent">Boletins</a> </li>
                        </ul> 
						<?php } ?>
						<?php if ($visualizar_pagina_ferramentas!="N"){ ?>
                        <ul> 
                            <li id="ferramenta_pai"><a href="#" class="top_parent">Ferramentas</a> 
                                <ul id="ferramenta_filho" style="display:none"> 
									<?php if ($visualizar_pagina_comparacao!="N"){ ?><li><a href="{site_url}clt_ou_pj">Comparativo CLT ou PJ</a></li><?php } ?>
                                    <?php if ($visualizar_pagina_ferramentas_indices!="N") { ?> <li><a href="{site_url}indices/">Índices</a></li> <?php } ?>
                                    <?php if ($visualizar_pagina_ferramentas_tabelas!="N") { ?><li><a href="{site_url}tabelas/">Tabelas</a></li> <?php } ?>
                                    <?php if ($visualizar_pagina_ferramentas_consultas!="N") { ?><li><a href="{site_url}consultas/">Consultas</a></li> <?php } ?>
                                    <?php if ($visualizar_pagina_ferramentas_certidoes!="N") { ?><li><a href="{site_url}certidoes/">Certidões</a></li> <?php } ?>
                                    <?php if ($visualizar_pagina_ferramentas_guias!="N") {?><li><a href="{site_url}guias/">Guias</a></li><?php } ?>
                                    {ferramentas}
                                    <li><a href="{site_url}paginas/texto/{id}/{url_amigavel}">{titulo_menu}</a></li>
                                    {/ferramentas}
                                </ul> 
                            </li> 
                        </ul>
						<?php } ?>		
                        <ul> 
                            <li><a href="{site_url}faleconosco/" class="top_parent">Fale Conosco</a> 
                        </ul> 
                    </nav>
                </div>
            </header>
            <div class="container">
                
                
                <aside>
                    <br/>
					
					<?php if ($visualizar_agenda!="N") {?>
						<h3  style="padding-left:30px">:: Agenda de Obrigações</h3>
						<br/>
						{agenda_obrigacao}
						<div id="bloco_agenda">
                        <b style="margin-left:10px">carregando ...</b>
						</div>
						<hr/>
					<?php } ?>
					<?php if ($visualizar_cotacao!="N") { ?>
						<div style="padding-left:50px">    
							<h3>:: Cotação do Dólar</h3>
							<script type="text/javascript" src="http://www.neosolutions.com.br/scripts/cotacao.php"> </script>
						</div>
						<hr/>
					<?php } ?>
					<?php if ($visualizar_indices!="N") {?>
						<div style="padding-left:50px">
							<h3>:: Índices Econômicos</h3>
							<script type="text/javascript" src="<?php echo $package_update; ?>/cliente_indices_js.php"> </script>
							<br/>
							<br/>
						</div>
						<hr/>
					<?php
					}
					?>
					{codigo_coluna}
                    <div style="text-align:center;">
					{certificados}
					{twitter_seguir}
					<div style="margin:0 auto;width:55px;">{facebook_curtir}</div>
					</div>
                    {twitter_aumentar_lateral}
					<?php if (($visualizar_agenda=="N")||($visualizar_cotacao=="N")||($visualizar_indices=="N")) { ?>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<?php } ?>
                </aside>
                <!-- CONTEÚDO -->