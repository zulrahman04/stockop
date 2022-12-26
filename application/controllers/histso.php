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
        $this->load->view($this->layout, $this->data);
    }

    public function listHist()
    {

        $vars = $this->input->get(null, TRUE);


        if (isset($vars['filter'])) {
            $SEARCH_VALUE = $vars['filter'];
        } else {
            $SEARCH_VALUE = null;
        }
        $LIMIT_VALUE = null;
        if (isset($vars['limit'])) {
            $LIMIT_VALUE = $vars['limit'];
        }
        $OFFSET_VALUE = $vars['offset'];
        $SORT_VALUE = $vars['sort'];
        $ORDER_VALUE = $vars['order'];


        $totalRows = $this->histso->get_num_rows($SEARCH_VALUE);
        $item = $this->histso->get_data($LIMIT_VALUE, $OFFSET_VALUE, $SORT_VALUE, $ORDER_VALUE, $SEARCH_VALUE);
        $data = array(
            'total' => $totalRows,
            'rows' => $item
        );

        echo json_encode($data);
    }

    public function listHist2()
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

}