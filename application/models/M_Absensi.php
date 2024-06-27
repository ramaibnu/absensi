<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Absensi extends CI_Model
{
    function get_absensi()
    {
        $this->db->from('tb_att as a');
        // $this->db->join('tb_karyawan as b', 'b.no_nik=a.id_finger');
        // $this->db->join('tb_personal as c', 'c.id_personal=b.id_personal');
        // $this->db->join('tb_depart as d', 'd.id_depart=b.id_depart');
        $this->db->order_by('a.datetime', 'DESC');
        $this->db->group_by('a.datetime');
        return $this->db->get();
    }
    // function get_absensifix()
    // {
    //     // $q =
    //     //     "SELECT 
    //     // id_att,
    //     // id_finger,
    //     // type,
    //     // datetime,
    //     // MIN(time) AS clockin,
    //     // CASE 
    //     //     WHEN COUNT(*) > 1 THEN MAX(time)
    //     //     ELSE NULL
    //     // END AS clockout
    //     // FROM 
    //     // tb_attfix
    //     // where 
    //     // datetime between '2023-01-04' and '2023-01-06'
    //     // GROUP BY 
    //     // id_finger, datetime
    //     // order by datetime,clockin asc";
    //     // return $this->db->query($q);
    // }
    function get_absenfirst()
    {
        $this->db->order_by('datetime', 'ASC');
        $this->db->limit(1);
        return $this->db->get('tb_att');
    }
    function get_abslast()
    {
        $this->db->order_by('id_att', 'DESC');
        $this->db->limit(1);
        return $this->db->get('tb_attfix');
    }
    function get_absensiall($date)
    {
        $this->db->where('datetime >', $date);
        $this->db->order_by('datetime', 'ASC');
        return $this->db->get('tb_att');
    }
    function get_absensifinger($dstart, $dend)
    {
        $this->db->from('tb_att as a');
        $this->db->join('tb_karyawan as e', 'e.no_nik=a.id_finger', 'left');
        $this->db->join('tb_personal as f', 'f.id_personal=e.id_personal', 'left');
        $this->db->join('tb_posisi as g', 'g.id_posisi=e.id_posisi', 'left');
        $this->db->join('tb_depart as h', 'h.id_depart=e.id_depart');
        $this->db->where('a.datetime >=', $dstart);
        $this->db->where('a.datetime <=', $dend);
        $this->db->order_by('a.datetime', 'DESC');
        return $this->db->get();
    }
    function get_absensifix($dstart, $dend)
    {
        $this->db->select('*,a.nik as nika,a.date as datea');
        $this->db->from('tb_jadwal as a');
        $this->db->join('tb_attfix as c', 'c.nik=a.nik and c.date=a.date', 'left');
        $this->db->join('tb_ket_kerja as d', 'd.kode_ket_kerja=a.kode_shift', 'left');
        $this->db->join('tb_karyawan as e', 'e.no_nik=a.nik', 'left');
        $this->db->join('tb_personal as f', 'f.id_personal=e.id_personal', 'left');
        $this->db->join('tb_posisi as g', 'g.id_posisi=e.id_posisi', 'left');
        $this->db->join('tb_depart as h', 'h.id_depart=e.id_depart');
        $this->db->where('a.date >=', $dstart);
        $this->db->where('a.date <=', $dend);
        $this->db->order_by('a.date', 'DESC');
        return $this->db->get();
    }
    function get_absenin($finger, $date, $schinstart, $schinend)
    {
        $this->db->where('id_finger', $finger);
        $this->db->where('date(datetime)', $date);
        $this->db->where('datetime <=', "$date $schinstart");
        $this->db->where('datetime >=', "$date $schinend");
        $this->db->order_by('datetime', 'ASC');
        return $this->db->get('tb_att');
    }
    function get_absenout($finger, $date, $schoutstart, $schoutend)
    {
        $this->db->where('id_finger', $finger);
        $this->db->where('date(datetime)', $date);
        $this->db->where('datetime >=', "$date $schoutstart");
        $this->db->where('datetime <=', "$date $schoutend");
        $this->db->order_by('datetime', 'ASC');
        return $this->db->get('tb_att');
    }
    function get_jadwalshift($id, $date)
    {
        $this->db->from('tb_jadwal as a');
        $this->db->join('tb_shift as b', 'b.kode_shift=a.kode_shift');
        $this->db->where('nik', $id);
        $this->db->where('date', $date);
        return $this->db->get();
    }
    function add_kalabsen($x)
    {
        $this->db->insert('tb_attfix', $x);
    }
}
