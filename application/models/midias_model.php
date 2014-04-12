<?php
class Midias_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_conteudo_midias()
    {
	$query = $this->db->get("site_midias");
        return $query->result();
    }
    
}
?>