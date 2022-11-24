<?php
class Histso extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Histso_model', 'histso');
        is_logged_in();
    }

    public function index()
    {
        $this->data['pagetitle'] = 'History SO';
        $this->data['menuname'] = 'History SO';
        $this->data['submenuname'] = '';
        $this->data['page'] = 'histso';

        // $this->data['data'] = $this->histso->getHist();
        // $this->data['data'] = json_decode($this->curl->simple_get($this->API.'index_get'));

        $data = array(
            'produk' => '',
            'toko' => '',
            'qty' => '',
            'exp' => '',
            'ket' => '',
            'by' => '',
            'date' => ''
        );
        $this->session->set_userdata($data);
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


    public function produk()
    {

        $responce = new StdClass;

        $data = array(
            'produk' => $this->input->post('produk')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }

    public function toko()
    {

        $responce = new StdClass;

        $data = array(
            'toko' => $this->input->post('toko')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }

    public function qty()
    {

        $responce = new StdClass;

        $data = array(
            'qty' => $this->input->post('qty')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }

    public function exp()
    {

        $responce = new StdClass;

        $data = array(
            'exp' => $this->input->post('exp')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }

    public function ket()
    {

        $responce = new StdClass;

        $data = array(
            'ket' => $this->input->post('ket')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }

    public function by()
    {

        $responce = new StdClass;

        $data = array(
            'by' => $this->input->post('by')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }

    public function date()
    {

        $responce = new StdClass;

        $data = array(
            'date' => $this->input->post('date')
        );
        $this->session->set_userdata($data);
        $responce = 'sukses';
        echo json_encode($responce);
    }
}