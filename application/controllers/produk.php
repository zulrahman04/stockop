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
            $row[] = '  <a href="#" class="btn btn-info" onclick="modal(' . $li->id . ')"><i class="fa fa-fw fa-eye"></i></a>
                        <a href="#" class="btn btn-primary" onclick="formEditProduk(' . $li->id . ')"><i class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" onclick="hapus(' . $li->id . ')"><i class="fa fa-fw fa-trash"></i></a>';
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

    public function listProdukDetail($id)
    {
        $responce = new StdClass;
        $list = $this->produk->produkDetail($id);
        $responce = '';
        foreach ($list as $key) {
            $responce .= '
            <tr>
                <td>' . $key->produk . '</td>
                <td>' . $key->nama . '</td>
                <td>' . $key->qty . '</td>
                <td>' . $key->expire . '</td>
            </tr>';
        }
        echo json_encode($responce);
    }

    public function addProduk()
    {
        $kd = $this->input->post('kdpr');
        $br = $this->input->post('barcode');
        $nm = $this->input->post('produk');
        $jns = $this->input->post('jns');
        $mrk = $this->input->post('merk');
        $stn = $this->input->post('satuan');

        $responce = new StdClass;

        if ($this->produk->cekProduk($kd)) {
            $responce->result = 'Invalid';
            $responce->message = 'Kode Produk Sudah Ada.';
            echo json_encode($responce);
        } elseif ($this->produk->addProduk($kd, $br, $nm, $jns, $mrk, $stn)) {
            $responce->result = 'Berhasil';
            $responce->message = 'Produk berhasil Ditambah.';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Produk gagal ditambah.';
            echo json_encode($responce);
        }
    }

    public function hapusProduk()
    {
        $id = $this->input->post('id');

        $responce = new StdClass;

        if ($this->produk->hapusProduk($id)) {
            $responce->result = 'Berhasil';
            $responce->message = 'Berhasil Hapus Produk.';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Gagal Hapus Produk.';
            echo json_encode($responce);
        }
    }

    public function getProduk()
    {
        $id = $this->input->post('id');
        echo json_encode($this->produk->getProduk($id));
    }

    public function editProduk()
    {
        $id = $this->input->post('id');
        $kd = $this->input->post('kdpr');
        $br = $this->input->post('barcode');
        $nm = $this->input->post('produk');
        $jns = $this->input->post('jns');
        $mrk = $this->input->post('merk');
        $stn = $this->input->post('satuan');

        $responce = new StdClass;

        if ($this->produk->editProduk($id, $kd, $br, $nm, $jns, $mrk, $stn)) {
            $responce->result = 'Berhasil';
            $responce->message = 'Produk berhasil Diubah.';
            echo json_encode($responce);
        } else {
            $responce->result = 'Gagal';
            $responce->message = 'Produk gagal Diubah.';
            echo json_encode($responce);
        }
    }

    public function import()
    {

        $this->load->library('excel');
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $temp_data[] = array(
                        'kode_item'    => $worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                        'barcode'    => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                        'nama'    => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                        'jenis'    => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
                        'merk'    => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                        'satuan'    => $worksheet->getCellByColumnAndRow(5, $row)->getValue()
                    );
                }
            }
            // echo '<pre>';
            // var_dump($temp_data);
            if ($this->produk->import($temp_data)) {
                redirect('produk');
            }
        } else {
            redirect('produk');
        }
    }
}