<?php
class Aviso_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_aviso()
    {
        $query = $this->db->get("site_aviso",1);
        return $query->result();
    }
}
?>
