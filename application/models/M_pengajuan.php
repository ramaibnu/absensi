<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengajuan extends CI_Model
{
    function get_pengajuanall()
    {
        $this->db->select('a.*,b.*,c.*,d.*,e.*,c.nama_lengkap as nm,e.nama_lengkap as nama');
        $this->db->from('tb_pengajuan as a');
        $this->db->join('tb_karyawan as b', 'b.no_nik=a.nik');
        $this->db->join('tb_personal as c', 'c.id_personal=b.id_personal');
        $this->db->join('tb_karyawan as d', 'd.no_nik=a.atasan', 'left');
        $this->db->join('tb_personal as e', 'e.id_personal=d.id_personal', 'left');
        return $this->db->get();
    }
    function get_karyall()
    {
        $this->db->from('tb_karyawan as a');
        $this->db->join('tb_personal as c', 'c.id_personal=a.id_personal');
        return $this->db->get();
    }
    function add_pengajuan($x)
    {
        $this->db->insert('tb_pengajuan', $x);
    }
    function upd_pengajuan($id)
    {
        $x = array(
            'status_doc' => 1
        );
        $this->db->where('id_pengajuan', $id);
        $this->db->update('tb_pengajuan', $x);
    }
    function getpengajuanid($id)
    {
        $this->db->where('id_pengajuan', $id);
        return $this->db->get('tb_pengajuan');
    }
}
