<?php
class Login_model extends CI_Model
{

    public function login($username, $password)
    {
        $password = md5($password);

        $where = array(
            'username' => $username,
            'password' => $password,
            'status' => 'A'
        );

        if ($user = $this->db->select("*")->from("user")->where($where)->get()->row()) {
            $query = " select m.mnu_id, m.mnu_name, m.mnu_uri, m.mnu_parent, m.mnu_icon, m.mnu_childyn
                        from mnu_mstr m
                        join accs_mstr a ON m.mnu_id = a.accs_menu
                        where a.accs_role = '" . $user->role . "'
                        and m.mnu_parent = 0
                        and a.accs_tf = 1
                        order by m.mnu_sort ASC";
            $parents = $this->db->query($query);

            $menu = array();
            if ($parents->num_rows() > 0) {
                foreach ($parents->result() as $parent) {
                    // $menu[] = $parent->mnu_name;
                    if ($parent->mnu_childyn == 'Y') {
                        $query = "
                                select m.mnu_id, m.mnu_name, m.mnu_uri, m.mnu_parent, m.mnu_sort
                                from mnu_mstr m
                                join accs_mstr a ON m.mnu_id = a.accs_menu
                                where a.accs_role = '" . $user->role . "'
                                and a.accs_tf = 1
                                and m.mnu_parent = '" . $parent->mnu_id . "'
                                order by m.mnu_sort ASC";
                        $childs = $this->db->query($query);
                        foreach ($childs->result() as $child) {
                            $menu[$parent->mnu_name][] = $child->mnu_name . ',' . $child->mnu_uri . ',' . $parent->mnu_icon;
                        }
                    } else {
                        $menu[$parent->mnu_name][] = $parent->mnu_name . ',' . $parent->mnu_uri . ',' . $parent->mnu_icon;
                    }
                }
            }


            $dashboard = $this->db->query("SELECT
                                        `mnu_mstr`.`mnu_name`
                                        , `mnu_mstr`.`mnu_uri` FROM `rol_mstr`
                                        INNER JOIN `accs_mstr`
                                            ON (`rol_mstr`.`rol_code` = `accs_mstr`.`accs_role`)
                                        INNER JOIN `mnu_mstr`
                                            ON (`mnu_mstr`.`mnu_id` = `accs_mstr`.`accs_menu`)
                                            WHERE `mnu_mstr`.`mnu_name` = 'dashboard'
                                            AND rol_mstr.rol_code ='$user->role'")->row_array();
            // Buat data session
            $time = time();
            $data = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'name' => $user->nama,
                'user_role' => $user->role,
                'login_status' => true,
                'menu' => $menu,
                'dashboardname' =>  $dashboard['mnu_name'],
                'dashboarduri' => $dashboard['mnu_uri'],
                'timestamp' => $time
            );

            $this->session->set_userdata($data);

            // Return login status, sukses.
            return true;
        }
        // Return false jika gagal.
        return false;
    }

    public function logout()
    {
        $this->session->unset_userdata(
            array('user_id' => '', 'username' => '', 'nama' => '', 'user_role' => '', 'dept_id' => '', 'login_status' => false, 'timestamp' => '')
        );
        $this->session->sess_destroy();
    }
}