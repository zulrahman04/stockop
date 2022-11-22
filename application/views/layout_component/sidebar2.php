<?php
$query = " select m.mnu_id, m.mnu_name, m.mnu_uri, m.mnu_parent, m.mnu_icon, m.mnu_childyn
	from mnu_mstr m
	join accs_mstr a ON m.mnu_id = a.accs_menu
	where a.accs_role = '" . $this->session->userdata('user_role') . "'
	and m.mnu_parent = 0
	and a.accs_tf = 1
	order by m.mnu_sort ASC
	";
$parents = $this->db->query($query);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url() ?>img/so2.png" alt="SO Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        &nbsp;<span class="brand-text font-weight-light">HRIS v2</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
                <?php
				if ($parents->num_rows() > 0) :
					foreach ($parents->result() as $parent) :
						if ($parent->mnu_childyn == 'Y') {
							if ($menuname == $parent->mnu_name) { ?>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon <?= $parent->mnu_icon ?>"></i>
                        <p>
                            <?= $parent->mnu_name ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <?php } else { ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="<?= $parent->mnu_icon ?> nav-icon"></i>
                        <p>
                            <?= $parent->mnu_name ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <?php }
							$query = "
								select m.mnu_id, m.mnu_name, m.mnu_uri, m.mnu_parent, m.mnu_sort
								from mnu_mstr m
								join accs_mstr a ON m.mnu_id = a.accs_menu
								where a.accs_role = '" . $this->session->userdata('user_role') . "'
								and a.accs_tf = 1
								and m.mnu_parent = '" . $parent->mnu_id . "'
								order by m.mnu_sort ASC
							";
							$childs = $this->db->query($query); ?>


                    <ul class="nav nav-treeview">
                        <?php foreach ($childs->result() as $child) {
										if ($submenuname == $child->mnu_name) { ?>

                        <li class="nav-item">
                            <a href="<?= base_url() . $child->mnu_uri ?>" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $child->mnu_name ?> </p>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item">
                            <a href="<?= base_url() . $child->mnu_uri ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $child->mnu_name ?></p>
                            </a>
                        </li>
                        <?php }
									} ?>
                    </ul>
                </li>
                <?php
							} else {
								if ($menuname == $parent->mnu_name) { ?>
                <li class="nav-item">
                    <a href="<?= base_url() . $parent->mnu_uri ?>" class="nav-link active">
                        <i class="nav-icon <?= $parent->mnu_icon ?>"></i>
                        <p>
                            <?= $parent->mnu_name ?>
                        </p>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item  ">
                    <a href="<?= base_url() . $parent->mnu_uri ?>" class="nav-link">
                        <i class="nav-icon <?= $parent->mnu_icon ?>"></i>
                        <p>
                            <?= $parent->mnu_name ?>
                        </p>
                    </a>
                </li>
                <?php }
							}
						endforeach;
					endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>