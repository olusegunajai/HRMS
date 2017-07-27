<div class="head white_box hidden-print">
  <span class="glyphicon glyphicon glyphicon-th-list" id="collapsemenu"></span>  
  <span class="title">
      <img src="images/icons/hr.png" width="36" height="30" />
	  <?php echo $pagetitle; ?>
  </span>
   <span class="topnav">
<!--    <img src="images/print.png" class="print" onClick="javascript:window.print()" width="16" height="16" alt="print">-->
      <ul class="">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span style="text-transform:capitalize;">
                <?php echo $_SESSION['MM_Username'].' ';?>
              </span>
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Edit Profile</a></li>
            <li><a href="adduser.php">Add User</a></li>
            <li role="separator" class="divider"></li>
          </ul>  
    </span>
   <a class="blue_text" style="text-decoration:none;" href="../cfaohr/default.php">
      <img src="images/home.jpg" onclick="disable" width="16" height="16">
    <span id="bal"> Home </span>
    </a>
    <a class="blue_text" style="text-decoration:none;" href="<?php echo $logoutAction ?>">
      <img src="images/icons/quit.png" width="16" height="16">
    <span id="bal">Logout</span>
    </a> 
        </li>
      </ul>
  </span>
</div>
