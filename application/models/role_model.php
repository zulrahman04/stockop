<?php
class Role_model extends CI_Model
{

    public function getRole()
    {
        return $this->db->select('id,rol_code,rol_name,rol_status')->from('rol_mstr')->get()->result();
    }

    public function saveAddRole($cdrole, $nmrole, $sts)
    {
        $this->db->trans_begin();
        $data = array(
            'rol_code' => $cdrole,
            'rol_name' => $nmrole,
            'rol_status' => $sts
        );
        $this->db->insert('rol_mstr', $data);

        $role = $this->db->select('mnu_id')->from('mnu_mstr')->get()->result();

        foreach ($role as $key) {
            $data = array(
                'accs_role' => $cdrole,
                'accs_menu' => $key->mnu_id,
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

    public function getEditRole($id)
    {
        return $this->db->select('rol_code,rol_name,rol_status')->from('rol_mstr')->where('id', $id)->get()->row();
    }

    public function saveEditRole($id, $cdroleold, $cdrole2, $nmrole2, $sts2)
    {

        $this->db->trans_begin();

        $data = array(
            'rol_code' => $cdrole2,
            'rol_name' => $nmrole2,
            'rol_status' => $sts2
        );
        $this->db->where('id', $id);
        $this->db->update('rol_mstr', $data);

        $data = array('accs_role' => $cdrole2);
        $this->db->where('accs_role', $cdroleold);
        $this->db->update('accs_mstr', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function deleteRole($id, $code)
    {

        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->delete('rol_mstr');

        $this->db->where('accs_role', $code);
        $this->db->delete('accs_mstr');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function accessrole($code)
    {
        $query = $this->db->query("SELECT
                                    mnu_mstr.mnu_name
                                    , mnu_mstr.mnu_id
                                    , mnu_mstr.mnu_parent
                                    , rol_mstr.rol_code
                                    , rol_mstr.rol_name
                                    , accs_mstr.accs_tf
                                FROM
                                    accs_mstr
                                    INNER JOIN mnu_mstr
                                        ON (accs_mstr.accs_menu = mnu_mstr.mnu_id)
                                    INNER JOIN rol_mstr
                                        ON (accs_mstr.accs_role = rol_mstr.rol_code)
                                        WHERE mnu_parent = '0'
                                        and rol_code = '$code'");

        return $query->result();
    }

    public function checkAccs($id, $role)
    {

        $cek = $this->db->query("SELECT mnu_childyn,mnu_parent
                                from mnu_mstr
                                where mnu_id = '$id'")->row();

        if ($cek->mnu_childyn != 'Y') {
            $this->db->trans_begin();

            $data = array('accs_tf' => 1);

            $this->db->where('accs_menu', $id);
            $this->db->where('accs_role', $role);
            $this->db->update('accs_mstr', $data);

            $this->db->where('accs_menu', $cek->mnu_parent);
            $this->db->where('accs_role', $role);
            $this->db->update('accs_mstr', $data);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $cek;
            }
        } else {
            $this->db->trans_begin();

            $data = array('accs_tf' => 1);
            $this->db->where('accs_menu', $id);
            $this->db->where('accs_role', $role);
            $this->db->update('accs_mstr', $data);

            $this->db->query("UPDATE accs_mstr set accs_tf = '1'
                            where accs_menu in (SELECT mnu_id FROM mnu_mstr WHERE mnu_parent = '$id')
                            and accs_role='$role'");

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $cek;
            }
        }
    }

    public function unCheckAccs($id, $role)
    {

        $cek = $this->db->query("SELECT mnu_childyn,mnu_parent
                                from mnu_mstr
                                where mnu_id = '$id'")->row();

        if ($cek->mnu_childyn != 'Y') {
            $this->db->trans_begin();

            $data = array('accs_tf' => 0);

            $this->db->where('accs_menu', $id);
            $this->db->where('accs_role', $role);
            $this->db->update('accs_mstr', $data);

            $cek2 = $this->db->query("SELECT COUNT(mnu_mstr.mnu_parent) AS jml FROM accs_mstr
                                    INNER JOIN mnu_mstr
                                        ON (accs_mstr.accs_menu = mnu_mstr.mnu_id)
                                        WHERE accs_role = '$role' AND accs_tf='1'
                                        AND mnu_parent = '$cek->mnu_parent' ")->row();
            if ($cek2->jml < 1) {
                $data = array('accs_tf' => 0);
                $this->db->where('accs_menu', $cek->mnu_parent);
                $this->db->where('accs_role', $role);
                $this->db->update('accs_mstr', $data);
            }
            $response = new stdClass();
            $response->jml = $cek2->jml;
            $response->parent = $cek->mnu_parent;


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $response;
            }
        } else {
            $this->db->trans_begin();

            $data = array('accs_tf' => 0);
            $this->db->where('accs_menu', $id);
            $this->db->where('accs_role', $role);
            $this->db->update('accs_mstr', $data);

            $this->db->query("UPDATE accs_mstr set accs_tf = '0'
                            where accs_menu in (SELECT mnu_id FROM mnu_mstr WHERE mnu_parent = '$id')
                            and accs_role='$role'");

            $response = new stdClass();
            $response->jml = 0;
            $response->parent = $cek->mnu_parent;

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $response;
            }
        }
    }
}