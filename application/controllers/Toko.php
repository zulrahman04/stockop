<?php
class Toko extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('toko_model', 'toko');
        is_logged_in();
    }

    public function index()
    {
        $this->data['pagetitle'] = 'Toko';
        $this->data['menuname'] = 'Master';
        $this->data['submenuname'] = 'Toko';
        $this->data['page'] = 'toko';


        $this->data['toko'] =  $this->toko->toko();
        $this->load->view($this->layout, $this->data);
    }

    public function addToko()
    {
        $toko = $this->input->post('toko');
        $alamat = $this->input->post('alamat');

        $responce = new StdClass;

        if ($this->toko->addToko($toko, $alamat)) {
            $responce->result = 'Berhasil';
            $responce->message = 'Produk berhasil Ditambah.';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Produk gagal ditambah.';
            echo json_encode($responce);
        }
    }

    public function editToko()
    {
        $id = $this->input->post('id');
        $toko = $this->input->post('toko');
        $alamat = $this->input->post('alamat');

        $responce = new StdClass;

        if ($this->toko->editToko($id, $toko, $alamat)) {
            $responce->result = 'Berhasil';
            $responce->message = 'Toko berhasil Diubah.';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Toko gagal Diubah.';
            echo json_encode($responce);
        }
    }


    public function getToko()
    {
        $id = $this->input->post('id');
        echo json_encode($this->toko->getToko($id));
    }

    public function hapus()
    {
        $id = $this->input->post('id');

        $responce = new StdClass;

        if ($this->toko->hapusToko($id)) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil Hapus Toko.';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal Hapus toko.';
            echo json_encode($responce);
        }
    }
}