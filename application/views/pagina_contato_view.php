<section class="conteudo">
        <h1 class="title_home">Fale Conosco</h1>
        
        <?php echo validation_errors("<div id=\"erro\"><ul><li>","</li></ul></div>"); ?>
        <br/>
        <?php //echo str_replace("?","",form_open("faleconosco/")); ?>
        <form action="{site_url}faleconosco" method="post" accept-charset="iso-8859-1" >
            <table>
                    <tr>
                            <td>Empresa</td>
                            
                            <td><input type="text" name="empresa" value="<?php echo set_value('empresa'); ?>" style="width:288px;" /></td>
                    </tr>
                    <tr>
                            <td>Nome/Contato</td>
                            <td><input type="text" name="contato" value="<?php echo set_value('contato'); ?>" style="width:288px;"/></td>
                    </tr>
                    <tr>
                            <td>E-mail</td>
                            <td><input type="text" name="email" value="<?php echo set_value('email'); ?>" style="width:288px;"/></td>
                    </tr>
                    <tr>	
                            <td>Assunto</td>
                            <td><input type="text" name="assunto" value="<?php echo set_value('assunto'); ?>" style="width:288px;"/></td>
                    </tr>
                    <tr>
                            <td>Comentário</td>
                            <td><textarea cols="35" rows="8"  name="comentario"><?php echo set_value('comentario'); ?></textarea></td>
                    </tr>
                    <tr>
                            <td></td>
                            <td><input type="submit" value="Enviar" /><br/><small>(obs: todos os campos são de preenchimento obrigatório.)</small></td>
                    </tr>
            </table>
            </form>                
</section>
