<?php
class Galeria_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_galeria()
    {
		$this->db->order_by("ID","DESC");
		$query = $this->db->get("site_galeria");
        return $query->result();
    }
    
    
}
?>