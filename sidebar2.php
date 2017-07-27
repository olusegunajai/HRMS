<?php require_once('Connections/conn.php'); ?>
<?php

mysql_select_db($database_conn, $conn);
$query_menu = "SELECT * FROM menu WHERE visible = 1 ORDER BY `position` ASC";
$menu = mysql_query($query_menu, $conn) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);

mysql_select_db($database_conn, $conn);
$query_rsPages = "SELECT * FROM pages WHERE visible = 1 AND menu_id = {$row_menu['menu_id']} ORDER BY `position` ASC";
$rsPages = mysql_query($query_rsPages, $conn) or die(mysql_error());
$row_rsPages = mysql_fetch_assoc($rsPages);
$totalRows_rsPages = mysql_num_rows($rsPages);
?>

<link rel="stylesheet" href="styles/hr.css" />
<aside class="nav grey_box noprint">
  	 <div class="head grey_box"><img src="images/logo-cfao-groupe01.png" width="24" height="24" /><span class="slogan">CFAO</span></div>
     <div class="lace"></div>
  <section id="link">
    <ul class="subject" style="color:rgba(255,255,255,1);">
		<?php while($row_menu = mysql_fetch_assoc($menu)){?>
			<li>
            <a href="<?php echo $row_menu['page_name'].'.php'; ?>">
            <img src="images/icons/<?php echo $row_menu['page_name'].'.png'; ?>" width="16" height="16" />
			<?php $row_menu['menu_name'] ?></a>
                <ul class="pages">
					<?php while($row_rsPages = mysql_fetch_assoc($rsPages)){?>

                   <li><a href="<?php echo $row_rsPages['page_name'].'.php'; ?>">
                   <img src="images/icons/recruit.png" width="16" height="16" /> <?php $row_rsPages['menu_name'] ?></a>
                   </li>
                   <?php } ?>
                </ul>
          </li>
	  <?php } ?>
	</ul>

 <!--     <ul>
                   <a href="benefits.php">
<li><img src="images/icons/benefits.png" width="16" height="16" /> Benefits &amp; Compensation</li></a>
          <ul>
           <a href="salary.php">
           <li class="hide"><img src="images/icons/salary.png" width="16" height="16" /> Staff Salary</li></a>
           <li class="hide"><a href="allowances.php"><img src="images/icons/allow.png" alt="" width="16" height="16" /> Allowances</a></li>
           <li><a href="leave.php"><img src="images/leave1.png" alt="" width="16" height="16" /> Leave</a></li>
           <li class="hide"><a href="pension.php"><img src="images/icons/pension.png" alt="" width="16" height="16" /> Pension</a></li>
<a href="gratuity.php"><li class="hide"><img src="images/icons/grat.png" alt="" width="16" height="16" /> Gratuity</li></a>          </ul>
     </ul>
     
     <ul>
<a href="health.php">
<li><img src="images/icons/health.png" alt="" width="16" height="16" /> Health Management</li></a>           <ul>
          <a href="hospital.php">
          <li><img src="images/icons/hlist.png" width="16" height="16" /> Hospital List</li></a>
<a href="care.php">
<li><img src="images/icons/care.png" alt="" width="16" height="16" /> Staff Care </li></a>
<a href="hmo.php">
<li><img src="images/icons/hmo.png" alt="" width="16" height="16" /> HMO Reconciliation</li></a>            </ul>
     </ul>
     
     <ul>
      <a href="talent.php"><li><img src="images/icons/training.png" width="16" height="16" /> Talent Management</li></a>
        <ul>
         <a href="training.php">
         <li><img src="images/icons/course.png" width="16" height="16" /> Training/Courses</li></a>
         <a href="logistics.php">
         <li><img src="images/icons/logistics.png" width="16" height="16" /> Logistics</li></a>
         <a href="reservations.php">
         <li><img src="images/icons/home.png" width="16" height="16" /> Reservations</li></a>
         <a href="feeding.php">
         <li><img src="images/icons/feed.png" width="16" height="16" /> Feeding</li></a>
        </ul>
     </ul>
     
    <ul>
          <a href="administration.php"><li><img src="images/icons/admin.png" width="16" height="16" /> Administration</li></a>
          <ul>
             <a href="manageposts.php">
             <li><img src="images/icons/post.png" width="16" height="16" /> Advertise Post</li></a>
             <a href="">
             <li><img src="images/icons/memo.png" width="16" height="16" /> Memo</li></a>
             <a href="">
             <li><img src="images/icons/query.png" width="16" height="16" /> Query</li></a>
             <a href="">
             <li><img src="images/icons/downloads.png" width="16" height="16" /> Download Forms</li></a>
     	  </ul>
    </ul>-->
</section>

<div class="lace"></div>
<footer class="grey_box">Copyright &copy; 2014-<?php echo date("Y")?> <br /><a href="http://www.ajaicorp.com">AjaiCorp Solutions</a> <br />All rights reserved</footer>

</aside>
<?php
mysql_free_result($menu);

mysql_free_result($rsPages);
?>
  	 