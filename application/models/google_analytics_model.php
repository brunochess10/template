<?php
class Google_analytics_model extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_google_analytics()
    {
        $query = $this->db->get("site_google_analytics",1);
        return $query->result();
    }
}
?>
