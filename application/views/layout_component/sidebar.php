<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url() ?>img/so2.png" alt="SO Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        &nbsp;<span class="brand-text font-weight-light">STOCK OP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
                <?php $menu = $this->session->userdata('menu');
                foreach ($menu as $key => $value) {
                    $parent = explode(",", $value[0]);
                    if ($key === $parent[0]) {
                        if ($menuname == $key) { ?>
                <li class="nav-item">
                    <a href="<?= base_url($parent[1]) ?>" class="nav-link active">
                        <i class="nav-icon <?= $parent[2] ?>"></i>
                        <p>
                            <?= $key ?>
                        </p>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a href="<?= base_url($parent[1]) ?>" class="nav-link">
                        <i class="nav-icon <?= $parent[2] ?>"></i>
                        <p>
                            <?= $key ?>
                        </p>
                    </a>
                </li>
                <?php }
                    } else { ?>
                <?php if ($menuname == $key) { ?>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active ">
                        <i class="nav-icon <?= $parent[2] ?>"></i>
                        <p>
                            <?= $key ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <?php } else { ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon <?= $parent[2] ?>"></i>
                        <p>
                            <?= $key ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <?php }
                            foreach ($value as $key2) {
                                if ($key !== $key2) {
                                    $child = explode(",", $key2); ?>
                    <ul class="nav nav-treeview">
                        <?php if ($submenuname == $child[0]) { ?>
                        <li class="nav-item">
                            <a href="<?= base_url($child[1]) ?>" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $child[0] ?> </p>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item">
                            <a href="<?= base_url($child[1]) ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $child[0] ?> </p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php }
                            }
                        }
                    } ?>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>