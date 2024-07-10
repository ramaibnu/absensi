<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Karyawan extends CI_Model
{
    function get_allkaryawan()
    {
        $this->db->from('tb_karyawan as a');
        $this->db->join('tb_personal as b', 'b.id_personal=a.id_personal');
        $this->db->join('tb_depart as c', 'c.id_depart=a.id_depart');
        $this->db->join('tb_posisi as d', 'd.id_posisi=a.id_posisi');
        $this->db->join('tb_tipe as e', 'e.id_tipe=a.id_tipe');
        return $this->db->get();
    }
}
