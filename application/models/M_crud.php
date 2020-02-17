<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_crud extends CI_Model
{
    public function tampildata($table)
    {
        return $this->db->get($table)->result();
    }
    public function tambahdata($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    public function formeditdata($nama_table, $idkey, $id)
    {
        return $this->db->get_where($nama_table, [$idkey => $id])->row();
    }
    public function editdata($nama_table, $idkey, $id, $data)
    {
        return $this->db->where($idkey, $id)->update($nama_table, $data);
    }
    public function hapusdata($nama_table, $idkey, $id)
    {
        return $this->db->delete($nama_table, [$idkey => $id]);
    }
    public function tampiljoin($tableawal, $tablekedua, $idgabung, $idutama)
    {
        // SELECT * LEFT JOIN `user` ON `transaksi`.`id_user`=`user`.`id_user` ORDER BY `id_transaksi` DESC
        $query = $this->db->select('*')
            ->from($tableawal)
            ->join($tablekedua, '' . $tableawal . '.' . $idgabung . '=' . $tablekedua . '.' . $idgabung . '', 'left')
            // ->order_by($idutama, 'DESC')
            ->get();
        return $query->result();
    }
    public function tampiljoin_where($tableawal, $tablekedua, $idgabung, $idkey, $id)
    {
        $query = $this->db->select('*')
            ->from($tableawal)
            ->where($idkey, $id)
            ->join($tablekedua, '' . $tableawal . '.' . $idgabung . '=' . $tablekedua . '.' . $idgabung . '', 'left')
            // ->order_by($idutama, 'DESC')
            ->get();
        return $query;
    }
}
