<?php
class Mnumstr_model extends CI_Model
{


    public function getMenu()
    {
        return $this->db->select('*')->from('mnu_mstr')->get()->result();
    }

    public function getMenuParent()
    {
        return $this->db->select('*')->from('mnu_mstr')->where('mnu_parent', '0')->get()->result();
    }

    public function saveAddParent($nmparent, $uriparent, $iconparent, $stsparent, $urutan)
    {
        $this->db->trans_begin();
        $data = array(
            'mnu_name' => $nmparent,
            'mnu_uri' => $uriparent,
            'mnu_icon' => $iconparent,
            'mnu_status' => $stsparent,
            'mnu_sort' => $urutan
        );
        $this->db->insert('mnu_mstr', $data);
        $id = $this->db->insert_id();
        $role = $this->db->select('*')->from('rol_mstr')->get()->result();

        foreach ($role as $key) {
            $data = array(
                'accs_role' => $key->rol_code,
                'accs_menu' => $id,
                'accs_tf' => '0'
            );
            $this->db->insert('accs_mstr', $data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function saveAddChild($prnchld, $mnuchld, $mnuurichld, $stschld, $urutan)
    {

        $this->db->trans_begin();

        $data = array('mnu_childyn' => 'Y');
        $this->db->where('mnu_id', $prnchld);
        $this->db->update('mnu_mstr', $data);

        $data = array(
            'mnu_parent' => $prnchld,
            'mnu_name' => $mnuchld,
            'mnu_uri' => $mnuurichld,
            'mnu_status' => $stschld,
            'mnu_sort' => $urutan
        );
        $this->db->insert('mnu_mstr', $data);
        $id = $this->db->insert_id();
        $role = $this->db->select('*')->from('rol_mstr')->get()->result();

        foreach ($role as $key) {
            $data = array(
                'accs_role' => $key->rol_code,
                'accs_menu' => $id,
                'accs_tf' => '0'
            );
            $this->db->insert('accs_mstr', $data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getMenuEdit($id)
    {
        return $this->db->select('*')->from('mnu_mstr')->where('mnu_id', $id)->get()->row();
    }

    public function saveEditMenu($id, $menu, $menuuri, $menuicon, $urutan, $status)
    {

        $this->db->trans_begin();


        $data = array(
            'mnu_name' => $menu,
            'mnu_uri' => $menuuri,
            'mnu_icon' => $menuicon,
            'mnu_status' => $status,
            'mnu_sort' => $urutan
        );
        $this->db->where('mnu_id', $id);
        $this->db->update('mnu_mstr', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function deleteMenu($id)
    {

        $this->db->trans_begin();

        $this->db->where('mnu_id', $id);
        $this->db->delete('mnu_mstr');

        $this->db->where('accs_menu', $id);
        $this->db->delete('accs_mstr');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}