<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-yellow bg-navy elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link">
      <img src="<?= base_url('assets/'); ?>img/logo.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Portal LMB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel pt-2 d-flex">
        <div class="image mt-2">
        <a href="<?= base_url('assets/'); ?>img/user-photo/<?= $user['profil_picture']; ?>" data-lightbox="img-1"><img src="<?= base_url('assets/'); ?>img/user-photo/<?= $user['profil_picture']; ?>" class="img-circle elevation-5" alt="User Image"></a>
        </div>
        <div class="info">
          <a href="<?= base_url(); ?>" class="d-block"><?= $user['nama']; ?>
          <p href="<?= base_url(); ?>" class="small text-white"><?= $user['inisial']; ?> - <?= $user['honda_id']; ?></p></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
        <!-- Query Menu -->
        <?php
        $menu_id = $this->session->userdata('menu_id');
        
        $queryMenu = "SELECT `user_menu`.`id`, `menu` FROM `user_menu`JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`. `menu_id` WHERE `user_access_menu`.`role_id` = $menu_id ORDER BY `user_access_menu`.`menu_id` ASC";
        
        $menu = $this->db->query($queryMenu)->result_array();
        
        ?>
       
        <!-- Looping Menu -->
        <?php foreach ($menu as $m) : ?>
                <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-brain"></i>
                <p>
                Akses - <?= $m['menu']; ?>
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>
            
         <!-- Looping Sub Menu -->
         <?php
         $menuId = $m['id'];
         $querySubMenu = "SELECT * FROM `user_sub_menu` WHERE `menu_id` = $menuId AND `is_active` = 1 ";
         $subMenu = $this->db->query($querySubMenu)->result_array();
         ?>

            <?php foreach ($subMenu as $sm) : ?>
                <ul class="nav nav-treeview">
                <li class="nav-item pl-1">
            <?php if($title == $sm['title']) :  ?>
                <a href="<?= base_url($sm['url']); ?>" class="nav-link active bg-yellow ">
                
            <?php else : ?>
                <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                
            <?php endif; ?>
                    <i class="nav-icon <?= $sm['icon']; ?>"></i>   
                    <p>
                        <?= $sm['title']; ?>
                    </p>
                </a>
            </li>
            </ul>
            <?php endforeach; ?>
        </li>
        <?php endforeach; ?>
        <li class="nav-header">Setting Account</li>
        <li class="nav-item">
            <?php if ($title == "Change Profile") : ?>
                <a href="<?= base_url('auth/changeprofile'); ?>" class="nav-link active">
            <?php else : ?>
                <a href="<?= base_url('auth/changeprofile'); ?>" class="nav-link">
            <?php endif; ?>
            <i class="nav-icon fas fa-users"></i>
            <p>
            Change Profile
            </p>
            </a>
        </li>
        <li class="nav-item">
            <?php if ($title == "Change Password") : ?>
                <a href="<?= base_url('auth/changepassword'); ?>" class="nav-link active">
            <?php else : ?>
                <a href="<?= base_url('auth/changepassword'); ?>" class="nav-link">
            <?php endif; ?>
            <i class="nav-icon fas fa-lock"></i>
            <p>
            Change Password
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
            Logout            
            </p>
            </a>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?php 
  $where =  $user['menu_id'];
  $queryInfo = "SELECT * FROM `info` WHERE `untuk` = $where AND `is_active` = 1 ";
  $info = $this->db->query($queryInfo)->result_array();
  ?>
  <?php if (!empty($info)): ?>
    <!-- Modal -->
    <div class="modal fade" id="papanInformasi" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <p class="lead text-center"><i class="fas fa-bullhorn"></i> Papan Informasi</p> 
            <table class="table table-striped" id="dataTable">
                <tbody>
                    <?php foreach ($info as $inf) : ?>
                        <?php echo "<tr><td><b>".$inf['nama_info']."</b> <span class='small float-right'>".$inf['timestamp']."</span><br>".$inf['info']."</td></tr>"; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary bt-xs" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <?php else : ?>
    <?php endif; ?>

