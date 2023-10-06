 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar control-sidebar ">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <div class="user-panel">
       <div class="pull-left image">
         <img src="<?php echo base_url('assets/admin/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
       </div>
       <div class="pull-right info">
         <p><?= $this->session->userdata('userId') ? $this->session->userdata('roleText') : 'Guest' ?></p>
         <a href="#">
           <div id="status"><i class="fa fa-circle text-success"></i><?php echo ' online'; ?> </div>
         </a>
       </div>
     </div>

     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu">
       <!-- <select name="store" class="form-control select2">
         <option value="">Select Store</option>
       </select> -->
       <li class="header">MAIN NAVIGATION</li>
       <li class="treeview">
         <a href="<?php echo base_url('admin'); ?>">
           <i class="fa fa-dashboard"></i><span> <?php echo 'Dashboard'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-book"></i><span><?php echo 'Category'; ?>
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/recipeCategory/index'); ?>">
               <i class="fa fa-circle-o"></i>Add</a>
           </li>
           <li><a href="<?php echo base_url('admin/recipeCategory/manage'); ?>">
               <i class="fa fa-circle-o"></i>Manage</a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-list-alt"></i><span><?php echo 'Ingredient'; ?>
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/ingredient/index'); ?>">
               <i class="fa fa-circle-o"></i>Add</a>
           </li>
           <li><a href="<?php echo base_url('admin/ingredient/manage'); ?>">
               <i class="fa fa-circle-o"></i>Manage</a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-cutlery"></i><span><?php echo 'Recipe'; ?>
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/recipe/index'); ?>">
               <i class="fa fa-circle-o"></i>Add</a>
           </li>
           <li><a href="<?php echo base_url('admin/recipe/manage'); ?>">
               <i class="fa fa-circle-o"></i>Manage</a>
           </li>
         </ul>
       </li>
       <li class="header"></li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-globe"></i>
           <span><?php echo 'Site Setting'; ?></span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/site_setting/'); ?>"><i class="fa fa-circle-o"></i><?php echo 'Add'; ?></a></li>
           <li><a href="<?php echo base_url('admin/site_setting/show'); ?>"><i class="fa fa-circle-o"></i><?php echo 'Manage'; ?></a></li>
           <!-- <li><a href="<?php echo base_url('admin/site_setting/home_page'); ?>"><i class="fa fa-circle-o"></i><?php echo 'Home Page Settings'; ?></a></li>
           <li><a href="<?php echo base_url('admin/site_setting/about_page'); ?>"><i class="fa fa-circle-o"></i><?php echo 'About Page Settings'; ?></a></li>
           <li><a href="<?php echo base_url('admin/site_setting/contact_page'); ?>"><i class="fa fa-circle-o"></i><?php echo 'Contact Page Settings'; ?></a></li>
           <li><a href="<?php echo base_url('admin/site_setting/service_page'); ?>"><i class="fa fa-circle-o"></i><?php echo 'Service Page Settings'; ?></a></li> -->

       </li>
     </ul>
   </section>
   <!-- /.sidebar -->
 </aside>