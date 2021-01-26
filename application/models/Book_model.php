<?php
class Book_model extends CI_Model
{
    function get($start = 0, $end = 0)
    {
        $this->db->select("details.*");

        if ($start and $end) {
            $this->db->where("DATE(tgl) >=", $start);
            $this->db->where("DATE(tgl) <=", $end);
        } else {
            $this->db->where("MONTH(tgl)", date("m"));
            $this->db->where("YEAR(tgl)", date("Y"));
        }

        return $this->db->get("details");
    }
}
