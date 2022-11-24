<?php
class Produk extends CI_Controller
{

    public $layout = 'layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model', 'produk');
        is_logged_in();
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

    public function export()
    {
        // Load plugin PHPExcel nya
        $this->load->library('excel');


        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Produk")
            ->setSubject("Produk")
            ->setDescription("List All Produk")
            ->setKeywords("Data Produk");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PRODUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
        // $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        // $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        // $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        // $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Kode Item");
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "Kode Barcode");
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "Nama Item");
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "Jenis");
        $excel->setActiveSheetIndex(0)->setCellValue('E1', "Merk");
        $excel->setActiveSheetIndex(0)->setCellValue('F1', "Satuan");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);

        $dt = $this->produk->getProdukAll();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($dt as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data->kode_item);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('B' . $numrow, $data->barcode, PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->jenis);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->merk);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->satuan);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("List Data Produk");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="List Data Produk.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}