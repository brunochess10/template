<?php
class Metatag_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_metatag($id)
    {
		$this->db->where("id_pagina","$id");
		$query = $this->db->get("site_metatags");
        return $query->result();
    }
}
?>