<?php
class Myaccount extends CI_Controller
{
	public $layout = 'layout';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
		is_logged_in();
	}

	public function index()
	{
		$this->data['pagetitle'] = "Akun Saya";
		$this->data['menuname'] = "Akun Saya";
		$this->data['submenuname'] = "";
		$this->data['page'] = "myaccount";

		$toaster_msg = $this->session->flashdata('toaster_msg');
		if (isset($toaster_msg) === false) {
			$this->data['flashmsg'] = "NA";
		} else {
			$this->data['flashmsg'] = $toaster_msg['message'];
		}

		$myaccountdata = $this->user->getMyAccountData($this->session->userdata('user_id'), '');
		$this->data['usrid'] = $myaccountdata->id;
		$this->data['usrnm'] = $myaccountdata->username;
		$this->data['pswd'] = '*******************';
		$this->data['name'] = $myaccountdata->nama;
		// $this->data['role'] = $myaccountdata->rol_name;

		// print_r($myaccountdata); die();

		$this->load->view($this->layout, $this->data);
	}

	public function changePassword()
	{
		$this->load->library('form_validation');

		$oldpass = $this->input->post('oldpswd');
		$newpass = $this->input->post('newpswd');

		$responce = new StdClass;

		$myaccountdata = $this->user->getMyaccountData($this->session->userdata('user_id'), $oldpass);
		if (!empty($myaccountdata->password)) {
			$result = $this->user->changePassword($newpass);
			if (!($result)) {
				$responce->result = "LIB_E001A";
				$responce->message = "Error change password !";
			} else {
				$responce->result = "Berhasil";
				$responce->message = "Ganti password berhasil ";
			}
		} else {
			$responce->result = "Gagal";
			$responce->message = 'Password lama salah.';
		}
		// $responce->successMessage = $myaccountdata->password;

		echo json_encode($responce);
		//exit;

	}
}