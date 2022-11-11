<?php
class Mnumstr extends CI_Controller
{
    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mnumstr_model', 'menu');
    }

    public function index()
    {
        $this->data['pagetitle'] = "Menu";
        $this->data['menuname'] = "System";
        $this->data['submenuname'] = "Menu";
        $this->data['page'] = "mnumstr";

        $this->data['menu'] = $this->menu->getMenu();

        $this->load->view($this->layout, $this->data);
    }

    public function getMnuParent()
    {
        echo json_encode($this->menu->getMenuParent());
    }

    public function addParentMenu()
    {
        $nmparent = $this->input->post('mnuparn');
        $uriparent = $this->input->post('mnuuri');
        $iconparent = $this->input->post('mnuicon');
        $stsparent = $this->input->post('stsparent');
        $urutan = $this->input->post('urutan');
        $responce = new StdClass;

        $add = $this->menu->saveAddParent($nmparent, $uriparent, $iconparent, $stsparent, $urutan);
        if ($add) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil membuat Menu';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal membuat Menu';
            echo json_encode($responce);
        }
    }

    public function addChildMenu()
    {
        $prnchld = $this->input->post('prnchld');
        $mnuchld = $this->input->post('mnuchld');
        $mnuurichld = $this->input->post('mnuurichld');
        $stschld = $this->input->post('stschld');
        $urutan = $this->input->post('urutanchild');
        $responce = new StdClass;

        $add = $this->menu->saveAddChild($prnchld, $mnuchld, $mnuurichld, $stschld, $urutan);
        if ($add) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil membuat Menu';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal membuat Menu';
            echo json_encode($responce);
        }
    }

    public function getEditMenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->menu->getMenuEdit($id));
    }

    public function saveEditMenu()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        $menuuri = $this->input->post('menuuri');
        $menuicon = $this->input->post('menuicon');
        $urutan = $this->input->post('urutan');
        $status = $this->input->post('status');

        $responce = new StdClass;

        $edit = $this->menu->saveEditMenu($id, $menu, $menuuri, $menuicon, $urutan, $status);
        if ($edit) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil Update Menu';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal Update Menu';
            echo json_encode($responce);
        }
    }

    public function deleteMenu()
    {
        $id = $this->input->post('id');
        $responce = new StdClass;

        $hapus = $this->menu->deleteMenu($id);
        if ($hapus) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil menghapus Menu';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal menghapus Menu';
            echo json_encode($responce);
        }
    }
}