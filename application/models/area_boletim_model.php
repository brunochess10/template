<?php
class Area_boletim_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_area()
    {
        $this->db->order_by("are_titulo","asc");    
        $query = $this->db->get("area_newsletter");
        return $query->result();
    }
    
    function insert_area_mailing($id,$areas){
        foreach($areas as $area){
            $this->db->set("aru_mailing_id",$id);
            $this->db->set("aru_area_id",$area);
            $this->db->insert("area_mailing");
        }
    }
}
?>

