<?php
    class Mail_model extends CI_Model{
         function __construct()
         {
            // Call the Model constructor
            parent::__construct();
         }
         
         function get_boletins($num_boletim){
             $this->db->order_by("mail_data","desc");
             $this->db->limit($num_boletim);
			 $this->db->select('mail_id,mail_data,mail_assunto');
             $query = $this->db->get("mail");
             return $query->result();
         }
         
         function get_one_boletim($id){
             $this->db->where("mail_id",$id);
             $query = $this->db->get("mail");
             return $query->result();             
         }
         
         function get_all_boletins($quantidade_por_pagina,$pagina,$palavra_chave){
             $this->db->order_by("mail_data","desc");
			 if ($palavra_chave!=""){
				$this->db->like("mail_assunto",$palavra_chave);
				$this->db->like("mail_corpo",$palavra_chave);
			 }
             $query = $this->db->get("mail",$quantidade_por_pagina,$pagina);
			 //echo $this->db->last_query();
             return $query->result();             
         }
         
		 function get_total($palavra_chave){
			$this->db->like("mail_assunto",$palavra_chave);
			$this->db->like("mail_corpo",$palavra_chave);
			$query = $this->db->get("mail");
			return $query->result();             
		 }
		 
		 function get_last(){
			 $this->db->order_by("mail_data","desc");
			 $query=$this->db->get("mail",1,0);
			 //echo $this->db->last_query();			 
			 //print_r($query);
			 return $query->result();
		 }
    }
?>
