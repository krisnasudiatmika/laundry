       <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img src="<?php echo base_url('theme/image/ss.png');?> " style="width: 100%" id="sidebarCollapse">

                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-home"></i>
                            Manage
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                          <li><a href="http://localhost/laundry/transaksi/search_trans">Go To</a></li>
                            <li><a href="http://localhost/laundry/manage/manage_customer">Edit Customer</a></li>
                            <li><a href="http://localhost/laundry/manage/master_item">Edit Item Master</a></li>
                            <li><a href="http://localhost/laundry/manage/item">Tambah Customer & Item</a></li>


                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('manage/semua_transaksi');?>">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Report
                        </a>

                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi');?>">
                            <i class="glyphicon glyphicon-link"></i>
                            Transaksi
                        </a>
                    </li>

                </ul>


            </nav>

            <!-- Page Content Holder -->
            <div id="content" class="container">
