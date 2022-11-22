<?php
class Toko_model extends CI_Model
{
    public function toko()
    {
        return $this->db->select('*')->from('toko')->get()->result();
    }

    public function addToko($toko, $alamat)
    {
        $this->db->trans_begin();

        $data = array(
            'nama' => $toko,
            'alamat' => $alamat
        );
        $this->db->insert('toko', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getToko($id)
    {
        return $this->db->select('*')->from('toko')->where('id', $id)->get()->row();
    }

    public function editToko($id, $toko, $alamat)
    {
        $this->db->trans_begin();


        $data = array(
            'nama' => $toko,
            'alamat' => $alamat
        );
        $this->db->where('id', $id);
        $this->db->update('toko', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function hapusToko($id)
    {
        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->delete('toko');

        // print_r($this->db->last_query()); die();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}