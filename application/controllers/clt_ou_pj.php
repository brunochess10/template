<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servico
 *
 * @author Bruno
 */
class Clt_ou_pj extends MY_Controller {

    function index() {
		################################################################################
		#  Seta o ID do SEO da P�gina
		################################################################################
		$this->seo_pagina(-1);
		################################################################################
		#  Seta o ID do SEO da P�gina
		################################################################################
					
        ################################################################################
        #  carrega as p�ginas no nosso layout e tamb�m passa os dados para as mesmas
        ################################################################################
        $this->load->library('parser');
        $this->parser->parse('topo_view', $this->conteudo);
        $this->parser->parse('pagina_clt_ou_pj_view', $this->conteudo);
        $this->parser->parse('rodape_view', $this->conteudo);
    }

}

?>