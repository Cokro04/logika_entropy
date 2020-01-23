<?php
class Data extends CI_Model
{
    public function get_criteria($a)
    {
        $this->db->select('*');
        $query = $this->db->get_where('tbl_criteria', array('id_workcenter' => $a));
        // $query = $this->db->get('tbl_criteria');
        return $query->result();
    }

    public function sumdata($a)
    {
        $this->db->select_sum('urgensi', 'urgensi');
        $this->db->select_sum('psd', 'psd');
        $this->db->select_sum('qty', 'qty');
        $this->db->select_sum('standard_time', 'stt');
        $this->db->select_sum('setup_time', 'sut');
        $query = $this->db->get_where('tbl_criteria', array('id_workcenter' => $a));
        return $query;
    }

    public function getdata($tabel)
    {
        $query = $this->db->get($tabel);
        return $query;
    }
}
