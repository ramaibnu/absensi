<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Jadwal extends CI_Model
{
    function get_departemenall()
    {
        return $this->db->get('tb_depart');
    }
    function get_departid($id_depart)
    {
        $this->db->where('id_depart', $id_depart);
        return $this->db->get('tb_depart');
    }
    function get_kary_depart($id_depart)
    {
        $this->db->from('tb_karyawan as a');
        $this->db->join('tb_depart as b', 'b.id_depart=a.id_depart');
        $this->db->join('tb_personal as c', 'c.id_personal=a.id_personal');
        $this->db->join('tb_posisi as d', 'd.id_posisi=a.id_posisi');
        $this->db->where('b.id_depart', $id_depart);
        return $this->db->get();
    }
    function get_kary_nama($nama)
    {
        $this->db->from('tb_personal as a');
        $this->db->join('tb_karyawan as b', 'b.id_personal=a.id_personal');
        $this->db->where('nama_lengkap', $nama);
        return $this->db->get();
    }
    function get_karyall()
    {
        $this->db->from('tb_personal as a');
        $this->db->join('tb_karyawan as b', 'b.id_personal=a.id_personal');
        return $this->db->get();
    }
    function add_jadwal($x)
    {
        $this->db->insert('tb_jadwal', $x);
    }
    function get_jadwalkary($nik, $start, $end)
    {
        $this->db->from('tb_jadwal as a');
        $this->db->join('tb_ket_kerja as b', 'b.kode_ket_kerja=a.kode_shift', 'left');
        $this->db->where('nik', $nik);
        $this->db->where('date >=', $start);
        $this->db->where('date <=', $end);
        return $this->db->get();
    }
    function get_jadwalkarytest($start, $end)
    {
        $this->db->where('date >=', $start);
        $this->db->where('date <=', $end);
        return $this->db->get('tb_jadwal');
    }
    function get_jadwalkarygroup($start, $end)
    {
        $q = "select * from tb_jadwal as a
        where date between '$start' and '$end'
        group by nik";
        return $this->db->query($q);
    }
    function upd_jadwal($nik, $date, $x)
    {
        $this->db->where('nik', $nik);
        $this->db->where('date', $date);
        $this->db->update('tb_jadwal', $x);
    }
}
