<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsProducts = 452;
$pageNum_rsProducts = 0;
if (isset($_GET['pageNum_rsProducts'])) {
  $pageNum_rsProducts = $_GET['pageNum_rsProducts'];
}
$startRow_rsProducts = $pageNum_rsProducts * $maxRows_rsProducts;

mysql_select_db($database_conn, $conn);
$query_rsProducts = "SELECT * FROM product";
$query_limit_rsProducts = sprintf("%s LIMIT %d, %d", $query_rsProducts, $startRow_rsProducts, $maxRows_rsProducts);
$rsProducts = mysql_query($query_limit_rsProducts, $conn) or die(mysql_error());
$row_rsProducts = mysql_fetch_assoc($rsProducts);

if (isset($_GET['totalRows_rsProducts'])) {
  $totalRows_rsProducts = $_GET['totalRows_rsProducts'];
} else {
  $all_rsProducts = mysql_query($query_rsProducts);
  $totalRows_rsProducts = mysql_num_rows($all_rsProducts);
}
$totalPages_rsProducts = ceil($totalRows_rsProducts/$maxRows_rsProducts)-1;

$queryString_rsProducts = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsProducts") == false && 
        stristr($param, "totalRows_rsProducts") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsProducts = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsProducts = sprintf("&totalRows_rsProducts=%d%s", $totalRows_rsProducts, $queryString_rsProducts);
?>
<?php require_once('control/productlist.php'); ?>
<?php require_once('control/logoutUser.php'); ?>
<?php require_once('control/pageaccess.php'); ?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logo Stores: Inventory</title>
<link rel="stylesheet" href="styles/print.css" />
<link rel="icon" type="image/icon" href="images/favicon.png" />
<script src="js/jquery-2.1.3.js"></script>
</head>

<body>
<a href="inventory.php"><div class="back_btn blue_box">Back</div></a>
<section class="content">
 <div class="head white_box"><span class="title"><img src="images/favicon.png" width="57" height="44"> Logo Stock Management</span></div>
     <div class="blue_lace"></div>
     
     <section class="maincontent white_box">
     	<h3 class="content_main_title">LIST OF STOCK AVAILABLE IN THE STORE</h3>
        <div class="blue_lace"></div>
       <div class="paginator">
        <div class="pageleft"> 
        <?php if ($pageNum_rsProducts > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_rsProducts=%d%s", $currentPage, 0, $queryString_rsProducts); ?>"><span class="dock blue_box"><<</span></a>
  <?php } // Show if not first page ?>
           <a href="<?php printf("%s?pageNum_rsProducts=%d%s", $currentPage, max(0, $pageNum_rsProducts - 1), $queryString_rsProducts); ?>"><span class="dock blue_box"><</span></a> </div>
        <div class="pageright"><span class="dock blue_box"><a href="<?php printf("%s?pageNum_rsProducts=%d%s", $currentPage, min($totalPages_rsProducts, $pageNum_rsProducts + 1), $queryString_rsProducts); ?>">></a></span>   
        <?php if ($pageNum_rsProducts < $totalPages_rsProducts) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_rsProducts=%d%s", $currentPage, $totalPages_rsProducts, $queryString_rsProducts); ?>"><span class="dock blue_box">>></span></a>
  <?php } // Show if not last page ?>
         </div>
        </div>
        <br />
        <hr />
   	   <table border="0" cellpadding="1" cellspacing="1" class="data_table">
           <tr class="blue_box">
             <th>S/N</th>
             <th>SKU</th>
             <th>NAME</th>
             <th>COLOUR</th>
             <th>TYPE</th>
             <th>COST</th>
             <th>PRICE</th>
             <th>QUANTITY</th>
             <th>LOCATION</th>
             <th>RECIEVED</th>
           </tr>
           <?php do { ?>
             <tr class="tr">
               <td><?php echo $row_rsProducts['productId']; ?></td>
               <td><?php echo $row_rsProducts['sku']; ?></td>
               <td><?php echo $row_rsProducts['name']; ?></td>
               <td><?php echo $row_rsProducts['color']; ?></td>
               <td><?php echo $row_rsProducts['type']; ?></td>
               <td><?php echo $row_rsProducts['costPrice']; ?></td>
               <td><?php echo $row_rsProducts['sellingPrice']; ?></td>
               <td><?php echo $row_rsProducts['quantity']; ?></td>
               <td><?php echo $row_rsProducts['location']; ?></td>
               <td><?php echo $row_rsProducts['rdate']; ?></td>
       
             </tr>
             <?php } while ($row_rsProducts = mysql_fetch_assoc($rsProducts)); ?>
             <tr>
             <tfoot></tfoot>
             </tr>
       </table>
        </div>
     </section>
</section>

<script src="js/nav.js"></script>
</body>
</html>
<?php
mysql_free_result($rsProducts);

mysql_free_result($rsproducts);
?>
