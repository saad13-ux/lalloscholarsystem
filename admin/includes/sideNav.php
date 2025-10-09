 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-rgb(22, 110, 47); elevation-4">
   <!-- Brand Logo -->
   <a href="dashboard.php" class="brand-link" style="background-color:rgba(18, 91, 38, 1);">
     <img src="../resources/images/lgulallo.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-bold justify-content-center align-item-center">LGU LAL-LO</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar" style="background-color:rgb(22, 110, 47);">

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="dashboard.php" class="nav-link <?= $page == 'Dashboard' ? 'active' : '' ?>">
             <i class="nav-icon fa fa-home"></i>
             <p>
               Home
             </p>
           </a>
         </li>
  
       


         <li class="nav-item">
           <a href="account.php" class="nav-link <?= $page == 'Accounts' ? 'active' : '' ?>">
             <i class="nav-icon fa fa-users"></i>
             <p>
               Accounts
               <?php
                $user_qry = $pdo->query("SELECT count(*) as cnt FROM user WHERE badge_notified_admin = 0");
                $u_result = $user_qry->fetch(PDO::FETCH_ASSOC);
                if ($u_result['cnt'] > 0) {
                ?>
                 <span class="badge badge-danger"><?= $u_result['cnt'] ?></span>
               <?php } ?>
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="application.php " class="nav-link  <?= $page == 'Applications' ? 'active' : '' ?>">
             <i class="nav-icon fa fa-address-book"></i>
             <p>
               Application
               <?php
                $qry = $pdo->query("SELECT count(*) as cnt FROM user_application WHERE badge_notified_admin = 0");
                $result = $qry->fetch(PDO::FETCH_ASSOC);
                if ($result['cnt'] > 0) {
                ?>
                 <span class="badge badge-danger"><?= $result['cnt'] ?></span>
               <?php } ?>
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="scholarships.php" class="nav-link <?= $page == 'Scholarships' ? 'active' : '' ?>">
             <i class="nav-icon fa fa-graduation-cap"></i>
             <p>
               Scholarships
             </p>
           </a>
         </li>
        <li class="nav-item">
  <a href="general_announcement.php" class="nav-link">
    <i class="nav-icon fas fa-bullhorn"></i>
    <p>Announcements</p>
  </a>
</li>


         <li class="nav-item">
           <a href="announcement.php" class="nav-link <?= $page == 'Announcements' ? 'active' : '' ?>">
             <i class="nav-icon fa fa-envelope"></i>
             <p>
               Payroll Annoucement
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="" class="nav-link">
             <i class="nav-icon fas fa-folder"></i>
             <p>
               Records
               <i class="fas fa-angle-down right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="reports.php" class="nav-link <?= $page == 'Reports' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Approved</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="decline.php" class="nav-link <?= $page == 'Decline' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Declined</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="pending.php" class="nav-link <?= $page == 'Pending' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Submitted</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="ongoing.php" class="nav-link <?= $page == 'Ongoing' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Pending</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="" class="nav-link">
             <i class="nav-icon fas fa-print"></i>
             <p>
               Reports
               <i class="fas fa-angle-down right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="payroll_report.php" class="nav-link <?= $page == 'Payroll Report' ? 'active' : '' ?>">
                 <i class="fas fa-print nav-icon"></i>
                 <p>Payroll</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="feedback.php" class="nav-link <?= $page == 'Feedback' ? 'active' : '' ?>">
             <i class="nav-icon fa fa-comment"></i>
             <p>
               Feedback
             </p>
             <?php
              $feedback_qry = $pdo->query("SELECT count(*) as cnt FROM feedback WHERE badge_notified_admin = 0");
              $f_result = $feedback_qry->fetch(PDO::FETCH_ASSOC);
              if ($f_result['cnt'] > 0) {
              ?>
               <span class="badge badge-danger"><?= $f_result['cnt'] ?></span>
             <?php } ?>
           </a>
         </li>
             <li class="nav-item">
               <a href="admin_account.php" class="nav-link <?= $page == 'Admin' ? 'active' : '' ?>">
                 <i class="fas fa-user nav-icon"></i>
                 <p>Admin</p>
               </a>
             </li>
         </li>
            <li class="nav-item">
               <a href="activity_log.php" class="nav-link <?= $page == 'Logs' ? 'active' : '' ?>">
                 <i class="fas fa-cog nav-icon"></i>
                 <p>Activty Logs</p>
               </a>
             </li>
         </li>


         

         
         
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>