<?php
class Empresa_model extends CI_Model{
    
    function get_conteudo_empresa()
    {
		$this->db->where("publicar","P");
		$this->db->order_by("prioridade","desc");
                $query = $this->db->get("site_empresa");
                return $query->result();
    }
}
?>