<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$query = " select m.mnu_id, m.mnu_name, m.mnu_uri, m.mnu_parent, m.mnu_icon, m.mnu_childyn
		from mnu_mstr m
		join accs_mstr a ON m.mnu_id = a.accs_menu
		where a.accs_role = 'DEV'
		and m.mnu_parent = 0
		and a.accs_tf = 1
		order by m.mnu_sort ASC";
		$parents = $this->db->query($query);

		$menu = '';
		if ($parents->num_rows() > 0) {
			foreach ($parents->result() as $parent) {
				// $menu[] = $parent->mnu_name;
				if ($parent->mnu_childyn == 'Y') {
					$query = "
				select m.mnu_id, m.mnu_name, m.mnu_uri, m.mnu_parent, m.mnu_sort
				from mnu_mstr m
				join accs_mstr a ON m.mnu_id = a.accs_menu
				where a.accs_role = 'DEV'
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
		var_dump($menu);
	}
}