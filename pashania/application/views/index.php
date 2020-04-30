<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Berdikari Farm</title>
<!-- for-mobile-apps -->
 <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets_berdikarifarm/images/logo3.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ternak Sapi, Investasi Sapi, Bagi Hasil" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
    function hideURLbar(){ window.scrollTo(0,1); } </script>

          <!-- modal login bootstrap -->
        <link href="<?php echo base_url(); ?>/assets_login/assets/css/bootstrap.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>/assets_login/assets/css/login-register.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

        <script src="<?php echo base_url(); ?>/assets_login/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets_login/assets/js/login-register.js" type="text/javascript"></script>
          <!-- modal login bootstrap -->

<!-- //for-mobile-apps -->
<link href="<?php echo base_url(); ?>/assets_berdikarifarm/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url(); ?>/assets_berdikarifarm/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets_berdikarifarm/css/flexslider.css" type="text/css" media="screen" property="" />
<!-- js -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets_berdikarifarm/js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<style type="text/css">
    .square {
      width: 100%;
      height: 240px;
      
      background-size: cover;
      background-position: center;
      margin: 10px;
      -webkit-transition: all 0.2s linear 0s;
      -moz-transition: all 0.2s linear 0s;
      -o-transition: all 0.2s linear 0s;
      -ms-transition: all 0.2s linear 0s;
    }
    
    
  </style>


<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets_berdikarifarm/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets_berdikarifarm/js/easing.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".scroll").click(function(event){   
      event.preventDefault();
      $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
  });
</script>
<!-- start-smoth-scrolling -->




</head>
  
<body>
<!-- header -->
  <div class="top-nav">
    <div class="container">
      <nav class="navbar navbar-default">
        <div class="navbar-header navbar-left">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
          <nav class="menu menu--shylock">
            <ul class="nav navbar-nav link-effect-7" id="link-effect-7">
              <li class="active"><a href="index.html" data-hover="Home">Home</a></li>
              <li><a href="about.html" data-hover="Tentang Kami">Tentang Kami</a></li>
              <li><a href="mail.html" data-hover="Data Ternak">Data Ternak</a></li>

              <?php if ($levelUser == '') { ?>
                
              

              <li><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();" data-hover="Login">Login</a></li>

            <?php }elseif($levelUser=='10' or $levelUser=='5') {?>

              <li><div class="dropdown">
                  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;">
                    <?php echo $namaUserGiven;?>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 10px;">
                    <a class="dropdown-item" href="<?php echo site_url('Managements/index');?>" style="margin-bottom: 10px; display: block;" ><i class="fa fa-user" style="margin-right: 10px;"></i>  Dashboard</a>
                    <a class="dropdown-item" href="<?php echo site_url('Login/logoutUser');?>" style="margin-bottom: 10px; display: block;" ><i class="fa fa-arrow-left" style="margin-right: 10px;"></i>  Logout</a>
                  </div>
                </div>
              </li>

            <?php } ?>

            </ul>
          </nav>
        </div>

      </nav>  
    </div>  
  </div>  
<!-- //header -->
<!-- banner -->
              <?php
               $no=0;
               if(!$dataLatarAktif->result()){ ?>
                <div class="banner" style="background-image: url(<?php echo base_url(); ?>/assets_berdikarifarm/images/banner.jpg);">
              <?php }else {
                foreach ($dataLatarAktif->result() as $row) {

                  ?>

              <div class="banner" style="background-image: url(<?php echo base_url(); ?><?php echo $row->gambarLatar;?>);">

              <?php } } ?>


    <div class="container">
      <div class="w3ls_logo">
        <img src="<?php echo base_url(); ?>/assets_berdikarifarm/images/logo2.png" style="width: 300px; height: 300px; margin: auto; display: block;">
      </div>
      <section class="slider" style="margin-top: -100px; margin-bottom: 0 ">
        <div class="flexslider" style="margin-bottom: 0">
          <ul class="slides" >

            <?php
               $no=0;
               if(!$dataHeadlineAktif->result()){ ?>
                <h3>Selamat datang di website resmi Berdikari Farm</h3>
              <?php }else {
                foreach ($dataHeadlineAktif->result() as $row) {

                  ?>
            <li>
              <div class="w3l_banner_info">
                <h3><?php echo $row->keterangan;?></h3>
              </div>
            </li>

          <?php } } ?>
            
          </ul>
        </div>
      </section>
      <!-- flexSlider -->
      
        <script defer src="<?php echo base_url(); ?>/assets_berdikarifarm/js/jquery.flexslider.js"></script>
        <script type="text/javascript">
        $(window).load(function(){
          $('.flexslider').flexslider({
          animation: "slide",
          start: function(slider){
            $('body').removeClass('loading');
          }
          });
        });
        </script>
      
      <!-- //flexSlider -->
    </div>
  </div>
<!-- //banner -->
<!-- banner-bottom -->
  <div class="banner-bottom">
    <div class="container">
      <div class="col-md-7 wthree_banner_bottom_left">
        <h2>Kami ingin menunjukkan kepada Anda perkembangan ternak yang sedang dipelihara pada kandang - kandang andalan kami.</h2>
      </div>
      <div class="col-md-5 wthree_banner_bottom_right">
        <div class="more">
          <a href="#gallery" class="button button--nina button--size-s" data-text="Lihat Sekarang">
            <span>L</span><span>i</span><span>h</span><span>a</span><span>t</span> <span>S</span><span>e</span><span>k</span><span>a</span><span>r</span><span>a</span><span>n</span><span>g</span>
          </a>
        </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
<!-- //banner-bottom -->
<!-- services -->
  <!-- <div class="services">
    <div class="container">
      <div class="col-md-4 agileits_service_grid">
        <div class="agileits_service_grid1">
          <span></span>
        </div>
        <h3>Etiam fringilla magna velit</h3>
        <p>Ut volutpat mi sit amet eros fermentum posuere. Sed mollis, tellus et imperdiet 
          aliquet, turpis ex tincidunt lectus.</p>
      </div>
      <div class="col-md-4 agileits_service_grid">
        <div class="agileits_service_grid2">
          <span></span>
        </div>
        <h3>amet eros fermentum posuere</h3>
        <p>Ut volutpat mi sit amet eros fermentum posuere. Sed mollis, tellus et imperdiet 
          aliquet, turpis ex tincidunt lectus.</p>
      </div>
      <div class="col-md-4 agileits_service_grid">
        <div class="agileits_service_grid3">
          <span></span>
        </div>
        <h3>Tellus et imperdiet turpis</h3>
        <p>Ut volutpat mi sit amet eros fermentum posuere. Sed mollis, tellus et imperdiet 
          aliquet, turpis ex tincidunt lectus.</p>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div> -->
<!-- //services -->
<!-- gallery -->
  <div class="gallery" id="gallery" style="margin-top: 50px;">
    <h3 class="head" style="margin-top: 50px;"><span class="glyphicon glyphicon-camera" style="text-align: center; display: block; margin: auto;" aria-hidden="true"></span>Foto Ternak Kami</h3>

    <div class="w3_gallery_grids">
      <div id="jzBox" class="jzBox">
        <div id="jzBoxNextBig"></div>
        <div id="jzBoxPrevBig"></div>
        <img src="#" id="jzBoxTargetImg" alt=" " />
        <div id="jzBoxBottom">
          <div id="jzBoxTitle"></div>
          <span id="jzBoxMoreItems">
            <div id="jzBoxCounter"></div>
            <i class="arrow-left" id="jzBoxPrev"></i> 
            <i class="arrow-right" id="jzBoxNext"></i> 
          </span>
          <i class="close" id="jzBoxClose"></i>
        </div>
      </div>

      <?php
                $no=0;
                if(!$dataTernak->result()){ ?>
                  <option value="" disabled="">Tidak ada kandang tersedia</option>

                <?php }else {
                  foreach ($dataTernak->result() as $row) {

                  ?>

          <div class="col-md-2 w3_gallery_grid">
            <a href="<?php echo base_url(); ?><?php echo $row->pictureTernak;?>" class="jzBoxLink" title="<?php if($row->aliasTernak){ echo $row->aliasTernak;}else { echo "Sapi #".$row->idTernak;}?>">
              <div class="square" style="background-image: url(<?php echo base_url(); ?><?php echo $row->pictureTernak;?>); "></div>
              
            </a>
            <div class="w3_gallery_grid1">
              <h4 style="margin-bottom: 0"><?php if($row->aliasTernak){ echo $row->aliasTernak;}else { echo "Sapi #".$row->idTernak;}?></h4>
              <p>
                Berat 
                 <?php
                $no=0;
                if(!$dataTerbaruBeratTernak->result()){ ?>
                  <option value="" disabled="">Tidak ada kandang tersedia</option>

                <?php }else {
                  foreach ($dataTerbaruBeratTernak->result() as $row2) {
                    if ($row2->idTernak==$row->idTernak) {
                  ?>

                  <?php echo $row2->beratTernak;?> Kg

                <?php } } }?>
              </p>
              <p>Kondisi ternak <?php echo $row->kondisiTernak;?></p>
            </div>
          </div>

        <?php } } ?>
         
          <div class="clearfix"> </div>
        <script src="<?php echo base_url(); ?>/assets_berdikarifarm/js/jzBox.js"></script>
    </div>
  </div>

   <div class="footer" style="background-color: #5c5c5c; margin-top: 30px;">
    <div class="container">
     
      
      <div class="col-md-12 text-center">
        <h1><span class="fa fa-bullhorn" style="text-align: center; display: block; margin: auto; color:#f2f2f2; margin-bottom: 20px;" aria-hidden="true"></span></h1>
        <h3 style="color: #f2f2f2;">HARGA PER SLOT HANYA</h3>
        <h1 class="text-center" style="font-size: 4em; color: #f2f2f2; font-weight: bold; margin-bottom: 40px;">

          <?php
               $no=0;
               if(!$dataHargaSlot->result()){ ?>
                Rp 0,-
              <?php }else {
                foreach ($dataHargaSlot->result() as $row) {

                  ?>

              <?php 
              if ($row->harga_slot > 1000000000) {
                $result = $row->harga_slot / 1000000000;
                echo $result." Miliar";
              }elseif ($row->harga_slot > 1000000) {
                $result = $row->harga_slot / 1000000;
                echo $result." Juta";
              }
              elseif ($row->harga_slot > 1000) {
                $result = $row->harga_slot / 1000;
                echo $result." Ribu";
              }
              ?>

              <?php } } ?>


        </h1>

        <a href="" class="btn btn-default btn-lg">Baca Ketentuan Berinvestasi</a>
        
      </div>
    </div>
  </div>
<!-- //gallery -->
<!-- features -->
  <div class="features">
    <div class="container">
      <h3 class="head">
        <span class="glyphicon glyphicon-comment" style="text-align: center; display: block; margin: auto;" aria-hidden="true"></span>
      Kami Menjanjikan</h3>
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs" role="tablist" style="width: auto;">
            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ternak Berkualitas</a></li>
            <li role="presentation"><a href="#Feature1" role="tab" id="Feature1-tab" data-toggle="tab" aria-controls="Feature1">Manajemen Pemeliharaan Berkualitas</a></li>
            <li role="presentation"><a href="#Feature2" role="tab" id="Feature2-tab" data-toggle="tab" aria-controls="Feature2">Pola Bagi Hasil Berimbang</a></li>
            <li role="presentation"><a href="#Feature3" role="tab" id="Feature3-tab" data-toggle="tab" aria-controls="Feature3">Komitmen Yang Tinggi</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
              <div class="w3agile_tabs">
                <div class="col-md-7 w3agile_tab_left">
                  <h4>suscipit sapien nec interdum sollicitudin</h4>
                  <p>Nunc faucibus lorem a arcu gravida, eget auctor eros 
                    ultrices. Vestibulum non erat ut odio euismod accumsan. 
                    Phasellus libero tellus, pulvinar vitae sem sit amet, 
                    faucibus consectetur neque.</p>
                  <ul>
                    <li>pulvinar vitae sem sit amet</li>
                    <li>faucibus consectetur neque</li>
                    <li>erat odio euismod accumsan</li>
                    <li>sapien nec interdum euismod</li>
                    <li>Phasellus libero tellus sem</li>
                    <li>gravida eget auctor eros</li>
                  </ul>
                </div>
                <div class="col-md-5 w3agile_tab_right w3agile_tab_right1">
                  <img src="<?php echo base_url(); ?>/assets_berdikarifarm/images/7.jpg" alt=" " class="img-responsive" />
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="Feature1" aria-labelledby="Feature1-tab">
              <div class="w3agile_tabs">
                <div class="col-md-5 w3agile_tab_right w3agile_tab_right2">
                  <img src="<?php echo base_url(); ?>/assets_berdikarifarm/images/8.jpg" alt=" " class="img-responsive" />
                </div>
                <div class="col-md-7 w3agile_tab_left">
                  <h4>pulvinar vitae sem sit amet non erat ut</h4>
                  <p>Nunc faucibus lorem a arcu gravida, eget auctor eros 
                    ultrices. Vestibulum non erat ut odio euismod accumsan. 
                    Phasellus libero tellus, pulvinar vitae sem sit amet, 
                    faucibus consectetur neque.</p>
                  <ul>
                    <li>pulvinar vitae sem sit amet</li>
                    <li>faucibus consectetur neque</li>
                    <li>erat odio euismod accumsan</li>
                    <li>sapien nec interdum euismod</li>
                    <li>Phasellus libero tellus sem</li>
                    <li>gravida eget auctor eros</li>
                  </ul>
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="Feature2" aria-labelledby="Feature2-tab">
              <div class="w3agile_tabs">
                <div class="col-md-7 w3agile_tab_left">
                  <h4>faucibus consectetur neque sollicitudin</h4>
                  <p>Nunc faucibus lorem a arcu gravida, eget auctor eros 
                    ultrices. Vestibulum non erat ut odio euismod accumsan. 
                    Phasellus libero tellus, pulvinar vitae sem sit amet, 
                    faucibus consectetur neque.</p>
                  <ul>
                    <li>pulvinar vitae sem sit amet</li>
                    <li>faucibus consectetur neque</li>
                    <li>erat odio euismod accumsan</li>
                    <li>sapien nec interdum euismod</li>
                    <li>Phasellus libero tellus sem</li>
                    <li>gravida eget auctor eros</li>
                  </ul>
                </div>
                <div class="col-md-5 w3agile_tab_right w3agile_tab_right1">
                  <img src="<?php echo base_url(); ?>/assets_berdikarifarm/images/9.jpg" alt=" " class="img-responsive" />
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="Feature3" aria-labelledby="Feature3-tab">
              <div class="w3agile_tabs">
                <div class="col-md-5 w3agile_tab_right w3agile_tab_right2">
                  <img src="<?php echo base_url(); ?>/assets_berdikarifarm/images/10.jpg" alt=" " class="img-responsive" />
                </div>
                <div class="col-md-7 w3agile_tab_left">
                  <h4>gravida eget auctor eros libero tellus</h4>
                  <p>Nunc faucibus lorem a arcu gravida, eget auctor eros 
                    ultrices. Vestibulum non erat ut odio euismod accumsan. 
                    Phasellus libero tellus, pulvinar vitae sem sit amet, 
                    faucibus consectetur neque.</p>
                  <ul>
                    <li>pulvinar vitae sem sit amet</li>
                    <li>faucibus consectetur neque</li>
                    <li>erat odio euismod accumsan</li>
                    <li>sapien nec interdum euismod</li>
                    <li>Phasellus libero tellus sem</li>
                    <li>gravida eget auctor eros</li>
                  </ul>
                </div>
                <div class="clearfix"> </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
<!-- //features -->
<!-- footer -->
 




        <div class="modal fade login" id="loginModal" style="margin: auto;">
          <div class="modal-dialog login animated">
              <div class="modal-content">
                 <div class="modal-header">
                        <button type="button" class="close" style="float: right;" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Gunakan akun anda</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box">
                             <div class="content">
                                
                                
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form action="<?php echo site_url('Login/selectLogin');?>" method="post" class="register-form" id="login-form">
                                    <input id="username" class="form-control" type="text" placeholder="Username" name="username">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                    <input class="btn btn-default btn-login" type="submit" value="Login">
                                    </form>
                                </div>
                             </div>
                        </div>
                        
                    </div>
                   
              </div>
          </div>
      </div>


      



<!-- //footer -->
<!-- copy-right -->
  <div class="w3agile_copy_right">
    <div class="container">
       <p>© <?php echo date("Y");?> Berdikari Farm | Design by W3layouts</p>
    </div>
  </div>
<!-- //copy-right -->
<!-- for bootstrap working -->
  <script src="<?php echo base_url(); ?>/assets_berdikarifarm/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
  <script type="text/javascript">
    $(document).ready(function() {
      /*
        var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear' 
        };
      */
                
      $().UItoTop({ easingType: 'easeOutQuart' });
                
      });
  </script>

  

  

<!-- //here ends scrolling icon -->
</body>
</html>