<?php
class Dashboard extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model', 'dashboard');
    }

    public function index()
    {
        $this->data['pagetitle'] = $this->session->userdata('dashboardname');
        $this->data['menuname'] = $this->session->userdata('dashboardname');
        $this->data['submenuname'] = '';
        $this->data['page'] = $this->session->userdata('dashboarduri');

        $this->data['data'] = $this->dashboard->getToko();
        // $this->data['data'] = json_decode($this->curl->simple_get($this->API.'index_get'));

        $this->load->view($this->layout, $this->data);
    }

    public function inputso()
    {
        $this->data['pagetitle'] = $this->session->userdata('dashboardname');
        $this->data['menuname'] = $this->session->userdata('dashboardname');
        $this->data['submenuname'] = 'Input SO';
        $this->data['page'] = 'inptso';

        $idtoko = $_GET['toko'];
        $this->data['toko'] = $this->dashboard->getTokoInpt($idtoko);
        $this->load->view($this->layout, $this->data);
    }

    public function getProdukBarcode()
    {
        $code = $this->input->post('code');
        $res = $this->dashboard->getItemBarcode($code);
        if ($res) {
            echo json_encode($res);
        } else {
            echo json_encode('Gagal');
        }
    }

    public function getExp()
    {
        $iditem = $this->input->post('iditem');
        $id_toko = $this->input->post('id_toko');
        $res = $this->dashboard->getExp($iditem, $id_toko);
        if ($res) {
            echo json_encode($res);
        } else {
            echo json_encode('Gagal');
        }
    }


    public function getQtyRed()
    {
        $iditem = $this->input->post('iditem');
        $id_toko = $this->input->post('id_toko');
        $exp = $this->input->post('exp');
        $res = $this->dashboard->getQtyRed($iditem, $id_toko, $exp);
        if ($res) {
            echo json_encode($res);
        } else {
            echo json_encode('Gagal');
        }
    }

    public function inptso()
    {
        $iditem = $this->input->post('iditem');
        $id_toko = $this->input->post('id_toko');
        $qty = $this->input->post('qty');
        $exp = $this->input->post('exp');
        $opt = $this->input->post('opt');
        $responce = new StdClass;

        $add = $this->dashboard->inptso($iditem, $id_toko, $qty, $exp, $opt);
        if ($add) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil Input SO';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal Input SO';
            echo json_encode($responce);
        }
    }
}