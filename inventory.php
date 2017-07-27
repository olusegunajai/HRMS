<?php
mb_http_input("utf-8");
mb_http_output("utf-8");
?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); $pagetitle = "Inventory";
?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logo Stores: Inventory</title>
<link rel="stylesheet" href="styles/hr.css" media="screen" />
<link rel="stylesheet" href="styles/print.css" media="print" />

<link rel="icon" type="image/icon" href="images/favicon.png" />
<script src="js/jquery-2.1.3.js"></script>
</head>

<body>
<section class="col-md-2" id="sidebar" style="text-decoration:none;">
	<?php require_once('sidebar.php'); ?>
</section>
<section class="col-md-10" id="page" width="100%">
  <section class="contents">
      <?php require_once('topnav.php'); ?>
      <div class="blue_lace"></div>
    <section class="maincontent white_box col-md-9" id="maincontent">
     	<h3 class="content_main_title">LIST OF STOCK AVAILABLE IN THE STORE</h3>
        <div class="blue_lace noprint"></div>
       <div class="paginator noprint">
        <div class="pageleft"> <span class="dock blue_box"><<</span> <span class="dock blue_box"><</span> </div>
        <div class="pageright"><span class="dock blue_box">></span> <span class="dock blue_box">>></span><a href="printstock.php" target="_new"><img src="images/print.png" class="print" width="22" height="20" alt="print"></a> </div>
       </div>
        <br />
   	   <table border="0" cellpadding="1" cellspacing="1" class="data_table">
           <tr class="blue_box">
             <th>S/N</th>
             <th>SKU</th>
             <th>NAME</th>
             <th>COLOUR</th>
             <th>TYPE</th>
             <th>COST</th>
             <th>PRICE</th>
             <th>QTY</th>
             <th>RECIEVED</th>
             <th>EDIT</th>
             <th>DEL</th>
           </tr>
           <tr class="tr">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td><a><img src="images/e.png" width="14" height="18" alt="Edit"></a></td>
             <td><a><img src="images/x.png" width="14" height="18" alt="Delete"></a></td>
           </tr>
<tr>
<tfoot></tfoot>
             </tr>
       </table>

     </section>
     
  <section class="analyser blue_box noprint">
     	     <h3 class="content_title">ADD  ITEM  TO THE STORE</h3>
        	 <div class="lace white_box"></div>
       <form method="POST" name="form1">
         <table align="center">
           <tr valign="baseline">
             <td><span id="sprytextfield1">
             <input name="sku" type="text" placeholder="sku" class="textbox1" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield2">
             <input name="name" type="text" placeholder="Product Name" class="textbox1" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Enter correect product name.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield3">
             <input name="color" type="text" placeholder="colour" class="textbox1" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield4">
             <input name="type" type="text" placeholder="Product Type" class="textbox1" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield5">
             <input name="costPrice" type="text" placeholder="Cost Price" class="textbox1" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Input price without currency.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><span id="sprytextfield6">
             <input name="sellingPrice" type="text" placeholder="Selling Cost" class="textbox1" size="32">
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Input price without currency.</span></span></td>
           </tr>
           <tr valign="baseline">
             <td><input name="quantity" type="text" placeholder="Quantity" class="textbox1" size="32">
             <input name="location" type="text" placeholder="Location" class="textbox1" size="32"></td>
           </tr>
           <tr valign="baseline">
             <td><input type="submit" class="button_app" value="Add Stock"><input type="reset" class="button_app_minus" value="Cancel"></td>
           </tr>
         </table>
         <input type="hidden" name="productId">
         <input type="hidden" name="rdate" value="<?php echo date("d/m/Y") ?>">
         <input type="hidden" name="MM_insert" value="form1">
       </form>
       <p>&nbsp;</p>

  </section>
</section>

<script src="js/nav.js"></script>
</body>
</html>
<?php
mysql_free_result($rsproducts);
?>
