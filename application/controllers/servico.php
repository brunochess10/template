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
class Servico extends MY_Controller {

    function index() {
		################################################################################
		#  Seta o ID do SEO da Página
		################################################################################
		$this->seo_pagina(-3);
		################################################################################
		#  Seta o ID do SEO da Página
		################################################################################
					
        ###############################
        # Carrega o Model
        ###############################
        $this->load->model("Servico_model");
            
        ######################################
        # Conteudo a ser apresentado na view
        ######################################
        $this->conteudo["conteudo_servico"] = $this->Servico_model->get_conteudo_servico();

        ################################################################################
        #  carrega as páginas no nosso layout e também passa os dados para as mesmas
        ################################################################################
        $this->load->library('parser');
        $this->parser->parse('topo_view', $this->conteudo);
        $this->parser->parse('pagina_servico_view', $this->conteudo);
        $this->parser->parse('rodape_view', $this->conteudo);
    }

}

?>
