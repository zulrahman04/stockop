<?php
class Histso extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Histso_model', 'histso');
    }

    public function index()
    {
        $this->data['pagetitle'] = 'History SO';
        $this->data['menuname'] = 'History SO';
        $this->data['submenuname'] = '';
        $this->data['page'] = 'histso';

        // $this->data['data'] = $this->histso->getHist();
        // $this->data['data'] = json_decode($this->curl->simple_get($this->API.'index_get'));

        $this->load->view($this->layout, $this->data);
    }

    public function listHist()
    {
        $list = $this->histso->get_datatables();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $li) {
            $row = array();

            $row[] = $no++;
            $row[] = $li->nama_produk;
            $row[] = $li->toko;
            $row[] = $li->qty;
            $row[] = $li->expire;
            $row[] = $li->keterangan;
            $row[] = $li->create_by;
            $row[] = $li->create_date;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->histso->count_all(),
            "recordsFiltered" => $this->histso->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }
}