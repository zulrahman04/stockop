<?php
class Histso_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data($limit, $offset, $sort, $order, $search)
    {
        $this->db->select('nama_produk, toko, qty, DATE_FORMAT(expire,"%d/%m/%Y") as expire, keterangan, create_by, DATE_FORMAT(create_date,"%H:%i:%s %d/%m/%Y") as create_date');
        $this->db->from('tr_hist');
        if ($search != null) {
            $arrsearch = json_decode($search);
            foreach ($arrsearch as $key => $value) {
                $this->db->like($key, $value);
            }
        }

        $query = $this->db->order_by($sort, $order)->limit($limit, $offset)->get();
        return  $query->result();
        // return $this->db->last_query();
    }

    public function get_num_rows($search)
    {
        if ($search != null) {
            $arrsearch = json_decode($search);
            foreach ($arrsearch as $key => $value) {
                $this->db->like($key, $value);
            }
        }

        return $this->db->get("tr_hist")->num_rows();
    }

    var $order = array('create_date' => 'desc');
    var $column_order = array('id', 'nama_produk', 'toko', 'qty', 'expire', 'keterangan', 'create_by', 'create_date');
    var $column_search = array('id', 'nama_produk', 'toko', 'qty', 'expire', 'keterangan', 'create_by', 'create_date');
    function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('tr_hist');
        if ($this->session->userdata('produk')) {
            $produk = $this->session->userdata('produk');
            $this->db->where("nama_produk LIKE '%$produk%'");
        }
        if ($this->session->userdata('toko')) {
            $toko = $this->session->userdata('toko');
            $this->db->where("toko LIKE '%$toko%'");
        }
        if ($this->session->userdata('qty')) {
            $qty = $this->session->userdata('qty');
            $this->db->where("qty LIKE '%$qty%'");
        }
        if ($this->session->userdata('exp')) {
            $exp = $this->session->userdata('exp');
            $this->db->where("expire LIKE '%$exp%'");
        }
        if ($this->session->userdata('ket')) {
            $ket = $this->session->userdata('ket');
            $this->db->where("keterangan LIKE '%$ket%'");
        }
        if ($this->session->userdata('by')) {
            $by = $this->session->userdata('by');
            $this->db->where("create_by LIKE '%$by%'");
        }
        if ($this->session->userdata('date')) {
            $date = $this->session->userdata('date');
            $this->db->where("create_date LIKE '%$date%'");
        }
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
        $this->db->select('*')->from('tr_hist');
        return $this->db->count_all_results();
    }
}