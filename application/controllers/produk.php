<?php
class Produk extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model', 'produk');
    }

    public function index()
    {
        $this->data['pagetitle'] = 'Produk';
        $this->data['menuname'] = 'Master';
        $this->data['submenuname'] = 'Produk';
        $this->data['page'] = 'produk';

        // $this->data['data'] = $this->dashboard->getToko();
        // $this->data['data'] = json_decode($this->curl->simple_get($this->API.'index_get'));

        $this->load->view($this->layout, $this->data);
    }

    public function listProduk()
    {
        $list = $this->produk->get_datatables();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $li) {
            $row = array();

            $row[] = $no++;
            $row[] = $li->kode_item;
            $row[] = $li->barcode;
            $row[] = $li->nama;
            $row[] = $li->jenis;
            $row[] = $li->merk;
            $row[] = $li->satuan;
            $row[] = '  <a href="" class="btn btn-info"><i class="fa fa-fw fa-eye"></i></a>
                        <a href="" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i></a>
                        <a href="" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->produk->count_all(),
            "recordsFiltered" => $this->produk->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }
}
