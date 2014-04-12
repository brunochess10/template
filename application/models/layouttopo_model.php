<?php

class Layouttopo_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_topo_site()
    {
        $this->db->where("publicar","S");
        $query = $this->db->get("site_layout_topo");
        return $query->result();
    }
}
?>
