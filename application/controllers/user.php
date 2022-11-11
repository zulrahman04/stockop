<?php
class User extends CI_Controller
{
  public $layout = 'layout';

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('user_model', 'user');
  }

  public function index()
  {
    $this->data['pagetitle'] = "User";
    $this->data['menuname'] = "Master";
    $this->data['submenuname'] = "User";
    $this->data['page'] = "user";

    $this->data['user'] = $this->user->getListUser();
    $this->load->view($this->layout, $this->data);
  }

  public function getPegawai()
  {
    echo json_encode($this->user->getListPegawai());
  }

  public function getRole()
  {
    echo json_encode($this->user->getRole());
  }

  public function addUser()
  {
    $username = $this->input->post('username');
    $role = $this->input->post('role');
    $nama = $this->input->post('nama');
    $status = $this->input->post('status');

    $responce = new StdClass;

    if ($this->user->cekUser($username)) {
      $responce->result = 'Invalid';
      $responce->message = 'Username Sudah Ada.';
      echo json_encode($responce);
    } elseif ($this->user->addUser($username, $role, $status, $nama)) {
      $responce->result = 'Berhasil';
      $responce->message = 'User berhasil dibuat.';
      echo json_encode($responce);
    } else {
      $responce->result = 'Gagal';
      $responce->message = 'User gagal dibuat.';
      echo json_encode($responce);
    }
  }

  public function getUser()
  {
    $username = $this->input->post('username');
    echo json_encode($this->user->cekUser($username));
  }

  public function editUser()
  {
    $id = $this->input->post('id');
    $nama = $this->input->post('nama');
    $role = $this->input->post('role');
    $status = $this->input->post('status');

    $responce = new StdClass;

    if ($this->user->editUser($id, $role, $status, $nama) > 0) {
      $responce->result = 'Berhasil';
      $responce->message = 'User berhasil diubah.';
      echo json_encode($responce);
    } else {
      $responce->result = 'Gagal';
      $responce->message = 'User gagal diubah.';
      echo json_encode($responce);
    }
  }

  public function deleteUser()
  {
    $id = $this->input->post('id');

    $responce = new StdClass;

    if ($this->user->deleteUser($id)) {
      $responce->result = 'Berhasil';
      $responce->message = 'User berhasil dihapus.';
      echo json_encode($responce);
    } else {
      $responce->result = 'Gagal';
      $responce->message = 'User gagal dihapus.';
      echo json_encode($responce);
    }
  }
}