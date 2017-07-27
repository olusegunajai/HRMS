<?php require_once('Connections/conn.php'); ?>
<!doctype html>
<html lang="en-NG">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>HR Home of Jobs and Opportunities</title>
<link rel="icon" href="../images/logo-cfao-groupe01.png">
<link href="public/public.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="styles/bootstrap.min.css" />
</head>

<body>
<?php include('header.php'); ?>
    <div class="row content container-fluid col-lg-12">
        <div class="row balloon col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-6 col-md-6 col-sm-6">
            	<!--<span>&nbsp;</span>-->
                <section class="col-lg-6 col- posi" id="logit">
                    <article class="row col-md">
                        <h1 class="orange_txt colorad orange leftborder col-lg-5"><strong>STAFF LOGIN</strong></h1>
                        <div class="colorad blue rightborder col-lg-7">
                        <p style="float:left;">Are you a staff? Click <a href="stafflogin.php" style="color:#FF0000">here</a> to sign on to your profile and please refer someone</p><span class="close close_m orange_txt" id="close_box" style="margin:0; margin-right:10px;">x</span>
                        </div>
                    </article>
                    <article class="msg_trot orange"></article>
              </section>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
            	<section class="flex f1 blue" id="gre" style="margin-top:20px;">
                    <article>
                        <h1 class="orange_txt"><strong>Who we are</strong></h1>
                        <p>An organization that represents the interests of over 12,000 human resource professionals at every level and hierarchy</p><span class="close close_m orange_txt" id="close_gre">x</span>
                    </article>
                    </section><br />
                    
                    <section class="flex grey_box f2" id="ora">
                    <article>
                      <h1 class="orange_txt"><strong>What we stand for</strong></h1>
                        <p>Cfao group is the largest distributor of various brands of quality consumable products</p><span class="close close_m orange_txt" id="close_ora">x</span>
                    </article>
                    </section><br />
                    
                  <section class="flex blue_box lemon f3" id="blu">
                    <article>
                        <h1 class="orange_txt"><strong>Why are you here?</strong></h1>
                        <p>Are you in search of a sustainable career with us then to view a pool of job vacancies available...<a href="jobs.php">Check out our job listings</a></p><span class="close close_m orange_txt" id="close_blu">x</span>
                    </article>
              </section>
          
            </div>
          
          
        </div>
    </div>

<?php include('footer.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/nav.js"></script>
</body>
</html>
