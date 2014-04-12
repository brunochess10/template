            <div class="avisos">
				<div id="contato">
					<img src="{base_url}imagens/ico_email.png" class="ico_contato"><br/><p><a href="mailto:{email}">{email}</a></p><br/>
					<img src="{base_url}imagens/ico_telefone.png" class="ico_contato"><p><b>{telefones}</b></p><br/><br/>
					<img src="{base_url}imagens/ico_relogio.png" class="ico_contato"><p>{funcionamento}</p>
					<!--<p id="funcionamento">{funcionamento} </p>-->
				</div>
            	<p id="aviso">
					{avisos}
                </p>
			</div>
			
			<?php if ($visualizar_noticias!="N"){ ?>
            <div class="noticias">
                <h1 class="title_home">Notícias</h1>
                <!--
				<ul>
                {noticias}        
                    <li><a href="{link}" target="_blank">{titulo}.</a></li>
                {/noticias}    
                </ul>
				-->
				<div id="lista_noticias">
					<b class="carregar">Carregando...</b>
				</div>
				{noticias}
				
            </div>
			<?php 
			}
			?>
			<?php if ($visualizar_boletins!="N"){ ?>
            <div class="boletins">
                <h1 class="title_home">Boletins</h1>
                <ul>
                    {boletim}
                    <li><a href="{site_url}boletim/texto/{mail_id}">{mail_data} - {mail_assunto}.</a></li>
                    {/boletim}    
                </ul>
            </div>     
			<?php
			}
			?>
            {twitter}
          