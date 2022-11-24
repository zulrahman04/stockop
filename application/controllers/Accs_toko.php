<?php
class Accs_toko extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model', 'user');
        $this->load->model('Toko_model', 'toko');
    }

    public function index()
    {
        $this->data['pagetitle'] = 'Akses Toko';
        $this->data['menuname'] = 'Akses Toko';
        $this->data['submenuname'] = '';
        $this->data['page'] = 'accsToko';
        $this->data['user'] = $this->user->getListUser();

        $this->load->view($this->layout, $this->data);
    }

    public function listAkses()
    {
        $id = $this->input->post('id');
        $list = $this->toko->get_datatables($id);
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $li) {
            $row = array();

            $row[] = $no++;
            $row[] = $li->nama;
            $row[] = $li->alamat;
            if (!$li->acs) {
                $check = "<input type='checkbox' id='$li->id' name='$li->id' value='$li->id' onclick='check($li->id,$id )'>";
            } else {
                $check = "<input type='checkbox' id='$li->id' name='$li->id' value='$li->id' onclick='check($li->id,$id )' checked>";
            }
            $row[] = $check;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->toko->count_all($id),
            "recordsFiltered" => $this->toko->count_filtered($id),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function checkAccs()
    {
        $responce = new StdClass;

        $id = $this->input->post('id');
        $ids = $this->input->post('ids');

        $result = $this->toko->checkAccs($id, $ids);
        if (!($result)) {
            $responce->result = "LIB_E001A";
            $responce->errorMessage = "Error Akses Toko !";
        } else {
            $responce->errorMessage = "";
            $responce->successMessage = "Akses Toko berhasil ditambahkan !";
        }
        echo json_encode($responce);
    }


    public function unCheckAccs()
    {
        $responce = new StdClass;

        $id = $this->input->post('id');
        $ids = $this->input->post('ids');

        $result = $this->toko->unCheckAccs($id, $ids);
        if (!($result)) {
            $responce->result = "LIB_E001A";
            $responce->errorMessage = "Error Akses Toko !";
        } else {
            $responce->errorMessage = "";
            $responce->successMessage = " AksesToko berhasil DiHapus !";
        }
        echo json_encode($responce);
    }
}
