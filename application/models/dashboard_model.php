<?php
class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getToko()
    {
        $userid = $this->session->userdata('user_id');
        $sql = "SELECT nama, toko.id FROM accs_toko
        INNER JOIN toko
            ON (accs_toko.id_toko = toko.id)where id_user = $userid";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getTokoInpt($id)
    {
        return $this->db->query("SELECT * FROM toko where id = '$id'")->row();
    }

    public function getItemBarcode($code)
    {
        return $this->db->query("SELECT * FROM produk where barcode = '$code'")->row();
    }

    public function getItemId($id)
    {
        return $this->db->query("SELECT * FROM produk where id = '$id'")->row();
    }

    public function getExp($iditem, $id_toko)
    {
        return $this->db->select("*")->from("produk_detail")->where("id_produk", $iditem)->where("id_toko", $id_toko)->get()->result();
    }

    public function getItmNoBarcode()
    {
        return $this->db->select("*")->from("produk")->where("barcode IS NULL OR barcode = ''")->get()->result();
    }

    public function getQtyRed($iditem, $id_toko, $exp)
    {
        return $this->db->select("*")->from("produk_detail")->where("id_produk", $iditem)->where("id_toko", $id_toko)->where("expire", $exp)->get()->row();
    }

    public function inptso($iditem, $id_toko, $qty, $exp, $opt)
    {
        $this->db->trans_begin();
        $cek = $this->db->query("SELECT * FROM produk_detail where id_produk = '$iditem' and id_toko = '$id_toko' and expire = '$exp' ")->row_array();
        if ($cek['id_produk']) {
            if ($opt == 'masuk') {
                $data = array(
                    'qty' => $qty + $cek['qty'],
                );
            } else {
                $data = array(
                    'qty' => $cek['qty'] - $qty,
                );
            }
            $this->db->where('id_produk', $iditem);
            $this->db->where('id_toko', $id_toko);
            $this->db->where('expire', $exp);
            $this->db->update('produk_detail', $data);
        } else {
            $data = array(
                'id_produk' => $iditem,
                'id_toko' => $id_toko,
                'qty' => $qty,
                'expire' => $exp
            );
            $this->db->insert('produk_detail', $data);
        }
        $cek2 = $this->db->query("SELECT * FROM produk where id = '$iditem'")->row_array();
        $cektoko = $this->db->query("SELECT * FROM toko where id = '$id_toko'")->row_array();


        if ($opt == 'masuk') {
            $qtyr = $qty;
            $ket = 'Barang Masuk';
        } else {
            $qtyr = -$qty;
            $ket = 'Barang Keluar';
        }

        $data = array(
            'id_produk' => $iditem,
            'nama_produk' => $cek2['nama'],
            'id_toko' => $id_toko,
            'toko' => $cektoko['nama'],
            'qty' => $qtyr,
            'expire' => $exp,
            'keterangan' => $ket,
            'create_by' => $this->session->userdata('name')
        );
        $this->db->insert('tr_hist', $data);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}