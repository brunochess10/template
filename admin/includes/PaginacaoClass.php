<?php
/*
    PaginacaoClass - Classe PHP de Montagem de Navegadores de P�gina
    ----------------------------------------------------------------
    Autor: Fernando Val <fernando.val@gmail.com>

    Descri��o:
        PaginacaoClass � uma classe em PHP para fazer os links de navega��o de p�gina no formato
        "Anterior <primeira> ... <n-3> <n-2> <n-1> N <n+1> <n+2> <n+3> ... <ultima> Pr�xima".

        A classe � totalmente personaliz�vel, permitindo que o programador defina os seguintes
        par�metros:

        - Link do site;
        - Vari�vel GET de defini��o da p�gina;
        - N�mero de p�ginas naveg�veis laterais a p�gina atual;
        - Texto usado para o separador da primeira e �ltiam p�ginas dos navegadores de p�ginas;
        - Texto da link "Anterior";
        - Texto do link "Pr�xima";
        - Classes HTML dos links, p�gina atual e separadores.

    Observa��es:
        - Esta classe foi totalmente escrita no idioma Portugu�s do Brasil, inclusive seu nome,
        propriedades e fun��es. N�o h� interesse do autor em portar nada para outros idiomas.
        Interessados em traduzir a documenta��o e instru��es para outros idiomas s�o bem vindos.
        Caso algu�m escreva alguma documenta��o em outro idioma, favor avisar o autor para que
        o documento e seus devidos cr�ditos sejam anexados ao projeto;
        - O autor agradece quaisquer coment�rios e sugest�es de melhorias.

    Licen�a:
        Esta classe � Open Source e distribuida sob a licen�a GPL.

    Hist�rico:
        1.00 - 21/Mar/2007 - Primeira vers�o da classe
*/

/*
    Exemplo de c�digo PHP de como usar esta classe
    ----------------------------------------------

    include('PaginacaoClass.php');
    $Paginacao = new Paginacao;
    $pag_atual = empty($_GET['pag']) ? 1 : (int)$_GET['pag'];
    $sql = 'SELECT COUNT(1) FROM minhatabela';
    $res = mysql_query($sql);
    $reg = mysql_fetch_row($res);
    $num_reg_lin = 10;
    $ultima_pag = ceil((int)$reg[0] / $num_reg_lin);
    // imprime os registros
    print $Paginacao->MontarPaginacao($pag_atual, $ultima_pag);
*/

class Paginacao {
    // Propriedades da classe
    var $PaginaAtual = 1;       // Define a p�gina atual
    var $UltimaPagina = 1;      // Define a quantidade de p�ginas
    var $NumPgLaterais = 3;     // Define quantas p�ginas ser�o naveg�veis para os lados a partir da p�gina atual
    var $SiteLink = '';         // Define o hyperlink dos navegadores
    var $PageGET = 'pag';       // Define a vari�vel do GET que receber� o n�mero da p�gina para navegar

    var $HTMLPaginacao = '';    // C�digo HTML com a navega��o

    var $TextoSeparador = '...';                    // Texto a ser mostrado como separador para primeira e �ltima p�ginas
    var $ClassePaginaAtual = 'paginacao_atual';     // Classe CSS usada para a LABEL de p�gina atual
    var $ClasseNavegadores = 'paginacao_navegar';   // Classe CSS usada para os LINKs de navega��o
    var $ClasseSeparadores = 'paginacao_atual';     // Classe CSS usada para os LABELS dos separadores de primeira e �ltima p�ginas

    var $TextoAnterior = 'Anterior';                // Texto a ser mostrado no link para a p�gina anterior
    var $TextoProxima = 'Pr&oacute;xima';           // Texto a ser mostrado no link para a pr�xima p�gina
	
	var $net_id ="";

    function MontarPaginacao($pgatual = 0, $pgfim = 0, $net_id = "", $status , $area, $pesquisa) {
		//echo "<script>alert('".$pesquisa."')</script>";
		//echo $pgatual." ".$pgfim;
        // Verifica se a p�gina atual e/ou a �ltima foram passadas por par�metro na chamada
        if ($pgatual)
            $this->PaginaAtual = $pgatual;
        if ($pgfim)
            $this->UltimaPagina = $pgfim;

        // Monta o link
        if (strpos($this->SiteLink, '?') === FALSE) {
            $link = $this->SiteLink . '?' . $this->PageGET . '=';
        } else {
            $link = $this->SiteLink . '&' . $this->PageGET . '=';
        }

        // Verifica se tem navaga��o pra p�gina anterior
        $anterior = '';
        if ($this->PaginaAtual > 1) {
            $anterior = '<A HREF="'.$link.($this->PaginaAtual - 1).'&net_id='.$net_id.'&net_id='.$net_id.'&area='.$area.'&status='.$status.'&pesquisa='.$pesquisa.'" CLASS="'.$this->ClasseNavegadores.'">'.$this->TextoAnterior.'</A> ';
        }

        // Verifica se mostra navegador para primeira p�gina
        $primeira = '';
        if (($this->PaginaAtual - ($this->NumPgLaterais + 1) > 1) && ($this->UltimaPagina > ($this->NumPgLaterais * 2 + 2))) {
            $primeira = '<A HREF="'.$link.'1&net_id='.$net_id.'&net_id='.$net_id.'&area='.$area.'&status='.$status.'&pesquisa='.$pesquisa.'" CLASS="'.$this->ClasseNavegadores.'">1</A> <LABEL CLASS="'.$this->ClasseSeparadores.'">'.$this->TextoSeparador.'</LABEL> ';
            $dec = $this->NumPgLaterais;
        } else {
            $dec = $this->PaginaAtual;
            while ($this->PaginaAtual - $dec < 1) {
                $dec--;
            }
        }

        // Verifica se mostra navegador para �ltima p�gina
        $ultima = '';
        if (($this->PaginaAtual + ($this->NumPgLaterais + 1) < $this->UltimaPagina) && ($this->UltimaPagina > ($this->NumPgLaterais * 2 + 2))) {
            $ultima = '<LABEL CLASS="'.$this->ClasseSeparadores.'">'.$this->TextoSeparador.'</LABEL> <A HREF="'.$link.$this->UltimaPagina.'&net_id='.$net_id.'&status='.$status.'&area='.$area.'&pesquisa='.$pesquisa.'" CLASS="'.$this->ClasseNavegadores.'">'.$this->UltimaPagina.'</A>';
            $inc = $this->NumPgLaterais;
        } else {
            $inc = $this->UltimaPagina - $this->PaginaAtual;
        }

        // Se houverem menos p�ginas anteriores que o definido, tenta colocar mais p�ginas para a frente
        if ($dec < $this->NumPgLaterais) {
            $x = $this->NumPgLaterais - $dec;
            while ($this->PaginaAtual + $inc < $this->UltimaPagina && $x > 0) {
                $inc++;
                $x--;
            }
        }
        // Se houverem menos p�ginas seguintes que o definido, tenta colocar mais p�ginas para tr�s
        if ($inc < $this->NumPgLaterais) {
            $x = $this->NumPgLaterais - $inc;
            while ($this->PaginaAtual - $dec > 1 && $x > 0) {
                $dec++;
                $x--;
            }
        }

        // Monta o conte�do central do navegador
        $atual = '';
        for ($x = $this->PaginaAtual - $dec; $x <= $this->PaginaAtual + $inc; $x++) {
            if ($x == $this->PaginaAtual) {
                $atual .= '<LABEL CLASS="'.$this->ClassePaginaAtual.'">'.$x.'</LABEL> ';
            } else {
                $atual .= '<A HREF="'.$link.$x.'&net_id='.$net_id.'&net_id='.$net_id.'&area='.$area.'&status='.$status.'&pesquisa='.$pesquisa.'" CLASS="'.$this->ClasseNavegadores.'">'.$x.'</A> ';
            }
        }

        // Verifica se mostra navegador para pr�xima p�gina
        $proxima = '';
        if ($this->PaginaAtual < $this->UltimaPagina) {
            $proxima = ' <A HREF="'.$link.($this->PaginaAtual + 1).'&net_id='.$net_id.'&area='.$area.'&status='.$status.'&pesquisa='.$pesquisa.'" CLASS="'.$this->ClasseNavegadores.'">'.$this->TextoProxima.'</A>';
        }

        return $this->HTMLPaginacao = $anterior.$primeira.$atual.$ultima.$proxima;
    }
}
?>