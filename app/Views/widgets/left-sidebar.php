<script src="<?=base_url()?>/public/js/kit.fontawesome.js" crossorigin="anonymous"></script>
<div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand" href="<?= base_url(); ?>/dashboard">
                        <div class="logo-img">
                            <img src="<?= base_url(); ?>/public/src/img/brand-white.png" class="header-brand-img" alt="lavalite">
                        </div>
                        <span class="text">&nbsp;cPanel</span>
                    </a>
                    <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                </div>

                <div class="sidebar-content">
                    <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">
                            <div class="nav-lavel">Overview</div>
                            <div class="nav-item <?=session()->getTempdata('dashboard')?>">
                                <a loading="true" href="<?= base_url(); ?>/dashboard"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="nav-item <?=session()->getTempdata('profile')?>">
                                <a loading="true" href="<?= base_url(); ?>/profile"><i class="ik ik-user"></i><span>Profile</span></a>
                            </div>
                            <!-- <div class="nav-item  has-sub">
                                <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Widgets</span> <span class="badge badge-danger">150+</span></a>
                                <div class="submenu-content">
                                    <a href="widgets.html" class="menu-item">Basic</a>
                                    <a href="widget-statistic.html" class="menu-item">Statistic</a>
                                    <a href="widget-data.html" class="menu-item">Data</a>
                                    <a href="widget-chart.html" class="menu-item">Chart Widget</a>
                                </div>
                            </div> -->
                            <div class="nav-lavel">Store Management</div>
                            <div class="nav-item <?=session()->getTempdata('store')?> has-sub">
                                <?php /*<a href="#" ><i class="fas fa-store-alt"></i><span>Store</span></a>*/?>
                                <div class="submenu-content">
                                    <a loading="true" href="<?= base_url(); ?>/store" class="menu-item"><i class="fas fa-store"></i><span>Store Front</span></a>
                                    <div class="nav-item has-sub">
                                        <a href="#" class="menu-item"><i class="fas fa-money-bill-alt"></i><span>Sales</span></a>
                                        <div class="submenu-content">
                                            <a loading="true" href="<?= base_url(); ?>/store/sales" class="menu-item">
                                                <i class="fab fa-sellcast"></i>
                                                <span>Direct Sales</span>
                                            </a>
                                            <a loading="true" href="<?= base_url(); ?>/store/credit_sales" class="menu-item">
                                                <i class="fab fa-sellsy"></i>
                                                <span>Credit Sales</span>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" class="menu-item"><i class="ik ik-shopping-cart"></i><span>Orders</span></a>
                                </div>
                            </div>

                            <div class="nav-item <?=session()->getTempdata('inventory')?> has-sub">
                                <a href="#"><i class="ik ik-archive"></i><span>Inventory</span></a>
                                <div class="submenu-content">
                                    <a loading="true" href="<?= base_url(); ?>/products/add" class="menu-item"><i class="ik ik-plus"></i><span>Add Product</span></a>
                                    <a loading="true" href="<?= base_url(); ?>/products" class="menu-item"><i class="ik ik-grid"></i><span>Products</span></a>
                                    <?php /* <a loading="true" href="<?= base_url(); ?>/products/add_category" class="menu-item"><i class="ik ik-folder-plus"></i><span>Add Category</span></a>
                                    <a loading="true" href="<?= base_url(); ?>/products/categories" class="menu-item"><i class="ik ik-layout"></i><span>Categories</span></a> */?>
                                </div>
                            </div>

                            <?php /*<div class="nav-lavel">Administration Management</div>*/?>
                            <?php /*<div class="nav-item <?=session()->getTempdata('customers')?> has-sub">*/?>
                                <?php /*<a href="#"><i class="fas fa-address-book"></i><span>Customers</span></a>
                                <div class="submenu-content">
                                    <a loading="true" href="<?= base_url(); ?>/customers/add" class="menu-item"><i class="ik ik-user-plus"></i><span>Add Customer</span></a>
                                    <a loading="true" href="<?= base_url(); ?>/customers" class="menu-item"><i class="ik ik-users"></i><span>Manage Customers</span></a>
                                </div>
                            </div>*/?>
                            <!--
                            <div class="nav-item ">
                                <a href="ui/icons.html"><i class="ik ik-command"></i><span>Icons</span></a>
                            </div>
                            <div class="nav-lavel">================</div>
                            -->
                           <?php /* <div class="nav-item <?=session()->getTempdata('users')?>*/?>
                            <?php /*<?=session()->getTempdata('roles')?> has-sub">
                                <a href="#"><i class="ik ik-edit"></i><span>Administration</span></a>
                                <div class="submenu-content">
                                    <a loading="true" href="<?=base_url()?>/users/add" class="menu-item"><i class="ik ik-user-plus"></i><span>Add User</span></a>
                                    <a loading="true" href="<?=base_url()?>/users" class="menu-item"><i class="ik ik-users"></i><span>Users</span></a>
                                    <a loading="true" href="<?=base_url()?>/roles" class="menu-item"><i class="ik ik-award"></i><span>User Roles</span></a>
                                </div>
                            </div>*/?>
                            <!--
                            <div class="nav-item ">
                                <a href="form-picker.html"><i class="ik ik-terminal"></i><span>Form Picker</span> <span class="badge badge-success">New</span></a>
                            </div>

                            <div class="nav-lavel">================</div>
                            <div class="nav-item ">
                                <a href="table-bootstrap.html"><i class="ik ik-credit-card"></i><span>Bootstrap Table</span></a>
                            </div>
                            <div class="nav-item ">
                                <a href="table-datatable.html"><i class="ik ik-inbox"></i><span>Data Table</span></a>
                            </div>

                            <div class="nav-lavel">Charts</div>
                            <div class="nav-item  has-sub">
                                <a href="#"><i class="ik ik-pie-chart"></i><span>Charts</span> <span class="badge badge-success">New</span></a>
                                <div class="submenu-content">
                                    <a href="charts-chartist.html" class="menu-item">Chartist</a>
                                    <a href="charts-flot.html" class="menu-item">Flot</a>
                                    <a href="charts-knob.html" class="menu-item">Knob</a>
                                    <a href="charts-amcharts.html" class="menu-item">Amcharts</a>
                                </div>
                            </div>

                            <div class="nav-lavel">Apps</div>
                            <div class="nav-item ">
                                <a href="calendar.html"><i class="ik ik-calendar"></i><span>Calendar</span></a>
                            </div>
                            <div class="nav-item ">
                                <a href="taskboard.html"><i class="ik ik-server"></i><span>Taskboard</span></a>
                            </div>

                            <div class="nav-lavel">================</div>

                            <div class="nav-item  has-sub">
                                <a href="#"><i class="ik ik-lock"></i><span>Authentication</span></a>
                                <div class="submenu-content">
                                    <a href="login.html" class="menu-item">Login</a>
                                    <a href="register.html" class="menu-item">Register</a>
                                    <a href="forgot-password.html" class="menu-item">Forgot Password</a>
                                </div>
                            </div>
                            <div class="nav-item  has-sub">
                                <a href="#"><i class="ik ik-file-text"></i><span>Other</span></a>
                                <div class="submenu-content">
                                    <a href="profile.html" class="menu-item">Profile</a>
                                    <a href="invoice.html" class="menu-item">Invoice</a>
                                </div>
                            </div>
                            <div class="nav-item ">
                                <a href="layouts.html"><i class="ik ik-layout"></i><span>Layouts</span><span class="badge badge-success">New</span></a>
                            </div>
                            <div class="nav-lavel">================</div>
                            <div class="nav-item  has-sub">
                                <a href="javascript:void(0)"><i class="ik ik-list"></i><span>Menu Levels</span></a>
                                <div class="submenu-content">
                                    <a href="javascript:void(0)" class="menu-item">Menu Level 2.1</a>
                                    <div class="nav-item  has-sub">
                                        <a href="javascript:void(0)" class="menu-item">Menu Level 2.2</a>
                                        <div class="submenu-content">
                                            <a href="javascript:void(0)" class="menu-item">Menu Level 3.1</a>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="menu-item">Menu Level 2.3</a>
                                </div>
                            </div>
                            <div class="nav-item ">
                                <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>Disabled Menu</span></a>
                            </div>
                            <div class="nav-item ">
                                <a href="javascript:void(0)"><i class="ik ik-award"></i><span>Sample Page</span></a>
                            </div>
                            <div class="nav-lavel">================</div>
                            <div class="nav-item ">
                                <a href="javascript:void(0)"><i class="ik ik-monitor"></i><span>Documentation</span></a>
                            </div>
                            <div class="nav-item ">
                                <a href="javascript:void(0)"><i class="ik ik-help-circle"></i><span>Submit Issue</span></a>
                            </div> -->
                        </nav>
                    </div>
                </div>
            </div>
