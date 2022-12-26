<?php
class User_model extends CI_Model
{

    public function getListUser()
    {
        $this->db->select('*');
        $this->db->from('user')->where("role != 'DEV'");

        $query = $this->db->get();

        //return $this->db->last_query();
        return $query->result();
    }

    public function getRole()
    {
        return $this->db->select('*')->from('rol_mstr')->where_not_in('rol_code', 'DEV')->get()->result();
    }

    public function cekUser($username)
    {
        return $this->db->select('*')->from('user')->where('username', $username)->get()->row();
    }

    public function getMyAccountData($usrid, $pass)
    {
        $this->db->select('id, username, password, nama');
        $this->db->from('user');
        $this->db->where('id', $usrid);
        if ($pass != '') {
            $this->db->where('password', md5($pass));
        }

        $query = $this->db->get();

        return $query->row();
    }

    public function changePassword($new)
    {
        $this->db->trans_begin();

        $data = array('password' => md5($new));
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function addUser($username, $role, $status, $nama)
    {
        $this->db->trans_begin();

        $data = array(
            'username' => $username,
            'password' => md5('123456'),
            'nama' => $nama,
            'role' => $role,
            'status' => $status,
            'created_by' => $this->session->userdata('username'),
            'update_by' => $this->session->userdata('username')
        );
        $this->db->insert('user', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function editUser($id, $role, $status, $nama)
    {

        $user = $this->session->userdata('username');
        $this->db->trans_begin();

        $this->db->query("UPDATE user SET role = '$role', update_by = '$user', status = '$status', nama = '$nama' WHERE id = '$id';");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function deleteUser($id)
    {
        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->delete('user');

        // print_r($this->db->last_query()); die();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function resetPassword($id)
    {
        $this->db->trans_begin();

        $data = array(
            'password' => md5('123456'),
            'update_by' => $this->session->userdata('username')
        );
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
