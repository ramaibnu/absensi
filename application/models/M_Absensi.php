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
    function get_absensifix()
    {
        // $q =
        //     "SELECT 
        // id_att,
        // id_finger,
        // type,
        // datetime,
        // MIN(time) AS clockin,
        // CASE 
        //     WHEN COUNT(*) > 1 THEN MAX(time)
        //     ELSE NULL
        // END AS clockout
        // FROM 
        // tb_attfix
        // where 
        // datetime between '2023-01-04' and '2023-01-06'
        // GROUP BY 
        // id_finger, datetime
        // order by datetime,clockin asc";
        // return $this->db->query($q);
    }
    function get_absensiall()
    {
        $this->db->order_by('datetime', 'ASC');
        return $this->db->get('tb_att');
    }
    function get_absenin($finger, $date)
    {
        $this->db->where('id_finger', $finger);
        $this->db->where('date(datetime)', $date);
        $this->db->order_by('datetime', 'ASC');
        return $this->db->get('tb_att');
    }
    function get_absenout($finger, $date)
    {
        $this->db->where('id_finger', $finger);
        $this->db->where('date(datetime)', $date);
        $this->db->order_by('datetime', 'DESC');
        return $this->db->get('tb_att');
    }
}
