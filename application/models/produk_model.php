<?php
class Produk_model extends CI_Model
{

    var $order = array('id' => 'asc');
    var $column_order = array('id', 'kode_item', 'barcode', 'nama', 'jenis', 'merk', 'satuan');
    var $column_search = array('id', 'kode_item', 'barcode', 'nama', 'jenis', 'merk', 'satuan');
    function _get_datatables_query()
    {
        $this->db->select('*')->from('produk');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->select('*')->from('produk');
        return $this->db->count_all_results();
    }


    function produkDetail($id)
    {
        $this->db->select('toko.nama, produk_detail.qty, produk_detail.expire, produk.nama AS produk');
        $this->db->from('toko');
        $this->db->join('produk_detail', 'toko.id = produk_detail.id_toko');
        $this->db->join('produk', 'produk_detail.id_produk = produk.id');
        $this->db->where('produk.id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getProduk($id)
    {
        return $this->db->select('*')->from('produk')->where('id', $id)->get()->row();
    }

    public function cekProduk($kd)
    {
        return $this->db->select('*')->from('produk')->where('kode_item', $kd)->get()->row();
    }

    public function addProduk($kd, $br, $nm, $jns, $mrk, $stn)
    {
        $this->db->trans_begin();

        $data = array(
            'kode_item' => $kd,
            'barcode' => $br,
            'nama' => $nm,
            'jenis' => $jns,
            'merk' => $mrk,
            'satuan' => $stn,
            'created_by' => $this->session->userdata('username'),
            'update_by' => $this->session->userdata('username')
        );
        $this->db->insert('produk', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function hapusProduk($id)
    {
        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->delete('produk');

        // print_r($this->db->last_query()); die();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function editProduk($id, $kd, $br, $nm, $jns, $mrk, $stn)
    {
        $this->db->trans_begin();


        $data = array(
            'kode_item' => $kd,
            'barcode' => $br,
            'nama' => $nm,
            'jenis' => $jns,
            'merk' => $mrk,
            'satuan' => $stn,
            'update_by' => $this->session->userdata('username')
        );
        $this->db->where('id', $id);
        $this->db->update('produk', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    public function import($temp_data)
    {
        $this->db->trans_begin();
        foreach ($temp_data as $key) {
            $cek = $this->db->select('kode_item')->from('produk')->where('kode_item', $key['kode_item'])->get()->row();
            if (!$cek) {
                $data = array(
                    'kode_item' => $key['kode_item'],
                    'barcode' => $key['barcode'],
                    'nama' => $key['nama'],
                    'jenis' => $key['jenis'],
                    'merk' => $key['merk'],
                    'satuan' => $key['satuan'],
                    'created_by' => $this->session->userdata('username'),
                    'update_by' => $this->session->userdata('username')
                );

                $this->db->insert('produk', $data);
            }
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
