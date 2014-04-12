<?php
class Alerta_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_conteudo_alerta()
    {
		$this->db->where("PUBLICAR","P");
		$this->db->order_by("ID","desc");
        $query = $this->db->get("site_alerta");
        return $query->result();
    }
}
?>