<section class="conteudo">
<?php //echo str_replace("?","",form_open("/boletim/lista/")); ?>
<form action="{site_url}boletim/lista" method="post">
Procure pelo assunto: <input type="" name="pesquisa" />
<input type="submit" value="Pesquisar ..." /> 
</form>
{lista_boletim}
<h1 class="title_home">{mes}</h1>
<ul>
    {assuntos}
</ul>
{/lista_boletim}
<br/>
{paginacao}
<hr/>
<?php echo str_replace("?","",form_open("boletim/remove_email/")); ?>
Se você não deseja mais receber nossos boletins preencha o cadastro abaixo:<br/><br/>
E-mail: <input type="text" name="email_descadastro" /> <input type="submit" value="Descadastrar" />
</form>
</section>