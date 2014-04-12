<?php
class Servico_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_conteudo_servico()
    {
		$this->db->where("publicar","P");
		$this->db->order_by("prioridade","desc");
        $query = $this->db->get("site_servico");
        return $query->result();
    }
}
?>