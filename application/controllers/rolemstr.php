<?php
class Rolemstr extends CI_Controller
{
    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_model', 'role');
        is_logged_in();
    }

    public function index()
    {
        $this->data['pagetitle'] = "Akses Menu Role";
        $this->data['menuname'] = "System";
        $this->data['submenuname'] = "Akses Menu Role";
        $this->data['page'] = "rolemstr";

        $this->data['role'] = $this->role->getRole();

        $this->load->view($this->layout, $this->data);
    }

    public function addRole()
    {
        $cdrole = $this->input->post('cdrole');
        $nmrole = $this->input->post('nmrole');
        $sts = $this->input->post('sts');
        $responce = new StdClass;

        $add = $this->role->saveAddRole($cdrole, $nmrole, $sts);
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

    public function getEditRole()
    {
        $id = $this->input->post('id');
        echo json_encode($this->role->getEditRole($id));
    }

    public function saveEditRole()
    {
        $id = $this->input->post('id');
        $cdroleold = $this->input->post('cdroleold');
        $cdrole2 = $this->input->post('cdrole2');
        $nmrole2 = $this->input->post('nmrole2');
        $sts2 = $this->input->post('sts2');

        $responce = new StdClass;

        $edit = $this->role->saveEditRole($id, $cdroleold, $cdrole2, $nmrole2, $sts2);
        if ($edit) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil Update Role';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal Update Role';
            echo json_encode($responce);
        }
    }

    public function deleteRole()
    {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $responce = new StdClass;

        $edit = $this->role->deleteRole($id, $code);
        if ($edit) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil Delete Role';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal Delete Role';
            echo json_encode($responce);
        }
    }

    public function access($code)
    {
        $this->data['pagetitle'] = "Akses Menu";
        $this->data['menuname'] = "System";
        $this->data['submenuname'] = "Akses Menu";
        $this->data['page'] = "roleakses";

        $this->data['role'] = $this->role->accessrole($code);

        $this->load->view($this->layout, $this->data);
    }

    public function checkAccs()
    {
        $responce = new StdClass;

        $id = $this->input->post('id');
        $role = $this->input->post('role');

        $result = $this->role->checkAccs($id, $role);
        if (!($result)) {
            $responce->result = "LIB_E001A";
            $responce->errorMessage = "Error delete Role !";
        } else {
            $this->session->set_flashdata('toaster_msg', array('message' => 'Role berhasil ditambahkan', 'class' => 'success'));

            $responce->result = $result->mnu_parent;
            $responce->result2 = $result->mnu_childyn;
            $responce->errorMessage = "";
            $responce->successMessage = "Role berhasil ditambahkan !";
        }
        echo json_encode($responce);
    }


    public function unCheckAccs()
    {
        $responce = new StdClass;

        $id = $this->input->post('id');
        $role = $this->input->post('role');

        $result = $this->role->unCheckAccs($id, $role);
        if (!($result)) {
            $responce->result = "LIB_E001A";
            $responce->errorMessage = "Error delete Role !";
        } else {
            $this->session->set_flashdata('toaster_msg', array('message' => 'Role berhasil ditambahkan', 'class' => 'success'));

            $responce->result = $result->jml;
            $responce->result2 = $result->parent;
            $responce->errorMessage = "";
            $responce->successMessage = "Role berhasil ditambahkan !";
        }
        echo json_encode($responce);
    }
}