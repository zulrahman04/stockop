<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect(base_url());
    } else {
        $inactive = 5000;
        if ((time() - $_SESSION['timestamp']) > $inactive) {
            redirect('login/logout');
        } else {
            $_SESSION['timestamp'] = time();
        }
        $role = $ci->session->userdata('user_role');

        $menu = $ci->uri->segment(1);

        $querymenu = $ci->db->get_where('mnu_mstr', ['mnu_uri' => $menu])->row_array();
        $menu_id = $querymenu['mnu_id'];

        $userAccess = $ci->db->get_where('accs_mstr', [
            'accs_role' => $role,
            'accs_menu' => $menu_id,
            'accs_tf' => '1'
        ]);
        if ($querymenu) {
            if ($userAccess->num_rows() < 1) {
                redirect('403_forbidden');
            }elseif(!$querymenu){
                redirect('404_override');
            }
        }
    }
}