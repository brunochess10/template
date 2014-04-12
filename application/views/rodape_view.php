          
            <!-- CONTEÚDO --> 


            <div class="baseaside" style="clear:right;"></div>
            <br style="clear:both"/>
            
    	</div>
   		<br/><br/>
		<footer>
		    <?php if ($logradouro!="") {?>
                	
				<a href="{site_url}localizacao" id="mapa_rodape">   
				
				<address>
				<p>Endereço</p>
				<span>
                {nome_fantasia}<br/>
                <!--&copy; {ano}. Todos os direitos reservados.<br/>-->
				{logradouro}&nbsp;{numero} {complemento} {bairro}<br>{cidade}/{estado} Cep:{cep}<br/>
				Tel.:{ddd} {telefone_1}  {fax} <br/>
				</span>
				</address>
                </a>    
			<?php }?>	
			
            <div class="informativo">
                
            <div id="boletim_mensagem" style="width:200px;float:left;">
            <p>
            Receba as principais notícias no seu e-mail cadastrando-se no nosso boletim Informativo, basta preencher os campos ao lado.
            </p>
            </div>
            <div  style="float:right;margin:50px 30px 0px 0px;" >
                <div style="border:none;width:210px">
                <form id="form_cadastro_temp"  method="post" style="float:left;">
					<table>
						<tr>
							<td style="color:#FFFFFF;font-size:8pt;">nome:</td><td><input type="text" name="nome_temp" id="nome_temp" size="12" /></td>
						</tr>
						<tr>
							<td style="color:#FFFFFF;font-size:8pt;">e-mail:</td><td><input type="pasword" name="email_temp" id="email_temp" size="12" style="margin-top:10px" /></td>
						</tr>
                   </table>
                </form>    
                <a href="#inline1" id="botao_boletim" style="font-size:8pt;"><br/>Cadastrar<!-- <img src="{base_url}imagens/botao_boletim.gif" style="border:none;float:right;" />--></a>
                </div>
                    <div style="display:none;">
                    <div id="inline1" style="width:400px;height:400px;overflow:auto;text-align:justify;font-family: Verdana, Geneva, sans-serif;font-size:12px;">
                     <?php //echo str_replace("?","",form_open("cadastro_boletim")); ?>
                     <form action="{site_url}cadastro_boletim" method="post">
                        <input type="hidden" name="nome" id="nome" size="12" /> <br/>
                        <input type="hidden" name="email_boletim" id="email_boletim" size="12" style="margin-top:10px" />
                        Marque as áreas das quais você deseja receber os boletins, por padrão 
                        você pode receber boletins de todas as áreas<br/><br/>
			{area_boletim}
                        <input type="submit" value="Confirmar" id="confirmar" />
                    </form>    
                    <br/>    
                    
                    </div>
                    </div>    
                
            </div>
            </div>
            <div class="neosolutions">
			{codigo_rodape}
			<a href="http://www.neosolutions.com.br/neosite.php" target="_blank">
            Desenvolvido por Neo Solutions - Soluções para escritórios contábeis - 11 3115-0188 <img src="{base_url}imagens/ico_neo_sitecontabil.png" alt="Neo Solutions - 11 31150188"/>
            </a>
            </div>
			<div class="copyright">&copy; {ano}. Todos os direitos reservados.</div>
			<br style="clear:both;">
        </footer>
    </div>
	{alerta}
</body>
</html>