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
    public function join4()
    {
        $query = $this->db->select('*')
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan=transaksi.id_pelanggan', 'left')
            ->join('user', 'user.id_user=transaksi.id_user', 'left')
            ->join('outlet', 'outlet.id_outlet=transaksi.id_outlet', 'left')
            ->get();
        return $query->result();
    }
    public function join3($id)
    {
        $query = $this->db->select('*')
            ->from('detail_transaksi')
            ->where('id_transak', $id)
            ->join('paket', 'paket.id_paket=detail_transaksi.id_paket', 'left')
            ->join('transaksi', 'transaksi.id_transaksi=detail_transaksi.id_transak', 'left')
            ->get();
        return $query->result();
    }
    public function autocomplete($title)
    {
        $this->db->like('nama', $title);
        $this->db->or_like('alamat', $title);
        $this->db->or_like('no_hp', $title);
        return $this->db->get('pelanggan')->result();
    }
}
