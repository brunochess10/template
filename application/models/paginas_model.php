<?php
    class Paginas_model extends CI_Model{
         function __construct()
         {
            // Call the Model constructor
            parent::__construct();
         }
         
         function get_institucional(){
             $this->db->where("menu_pai","1");
             $query = $this->db->get("site_paginas");
             return $query->result();
         }

         function get_ferramentas(){
             $this->db->where("menu_pai","2");
             $query = $this->db->get("site_paginas");
             return $query->result();
         }
         
         function get_one_page($id){
             $this->db->where("id",$id);
             $query = $this->db->get("site_paginas");
             return $query->result();
         }
    }
?>
