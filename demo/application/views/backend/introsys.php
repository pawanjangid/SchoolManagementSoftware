<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Anom The Wonder Connectivity
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>



<body class="" >
<!-- Navigation -->

  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav" style="border-color: red;opacity: 1;">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Anom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">add_shopping_cart</i> Products
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="<?php echo base_url(); ?>index.php?introsys/school" class="dropdown-item">
                <i class="material-icons">supervisor_account</i> School Management
              </a>
              <a href="<?php echo base_url(); ?>index.php?introsys/nidhi_company" class="dropdown-item">
                <i class="material-icons">account_balance</i> Nidhi Company
              </a>
              <a href="<?php echo base_url(); ?>index.php?introsys/nidhi_company" class="dropdown-item">
                <i class="material-icons">account_balance</i> Finance Company
              </a>
              <a href="<?php echo base_url(); ?>index.php?introsys/shop_management" class="dropdown-item">
                <i class="material-icons">store</i> Shop Management
              </a>
              <a href="<?php echo base_url(); ?>index.php?introsys/institute_management" class="dropdown-item">
                <i class="material-icons">golf_course</i> Institute Management
              </a>
              <a href="<?php echo base_url(); ?>index.php?introsys/real_state" class="dropdown-item">
                <i class="material-icons">location_city</i> Real State
              </a>
            </div>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons"></i> Web Services
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="./index.html" class="dropdown-item">
                <i class="material-icons">filter_tilt_shift</i> Web Development
              </a>
              <a href="<?php echo base_url(); ?>" class="dropdown-item">
                <i class="material-icons">phone_android</i> App Development
              </a>
              <a href="<?php echo base_url(); ?>" class="dropdown-item">
                <i class="material-icons">gamepad</i> Logo Designing
              </a>
              <a href="<?php echo base_url(); ?>" class="dropdown-item">
                <i class="material-icons">computer</i> Software Development
              </a>
            </div>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons"></i> Designing Services
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="./index.html" class="dropdown-item">
                <i class="material-icons">graphic_eq</i> VFX
              </a>
              <a href="<?php echo base_url(); ?>" class="dropdown-item">
                <i class="material-icons">control_camera</i> 2D-animation
              </a>
              <a href="<?php echo base_url(); ?>" class="dropdown-item">
                <i class="material-icons">drag_indicator</i> 3D-Animation
              </a>
              <a href="<?php echo base_url(); ?>" class="dropdown-item">
                <i class="material-icons">bubble_chart</i> Motion Graphics
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>index.php?introsys/contact_us">
              <i class="material-icons">notifications</i> Contact Us
            </a>
          </li>
           <li class="nav-item">
            <a class="" href="<?php echo base_url(); ?>index.php?introsys/login">
              <button class="btn btn-primary btn-round">
                <i class="material-icons">favorite</i> Login
              </button>
            </a>
          </li>




          
<!--           <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="<?php echo base_url(); ?>" target="_blank" data-original-title="Follow us on Twitter">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="<?php echo base_url(); ?>" target="_blank" data-original-title="Like us on Facebook">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="<?php echo base_url(); ?>" target="_blank" data-original-title="Follow us on Instagram">
              <i class="fa fa-instagram"></i>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>





















<!-- End Navigation -->


	
		


			<?php include 'introsys/'.$page_name.'.php';?>




    <!--  End Modal -->
  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="<?php echo base_url(); ?>">
              Anom
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>">
              About Us
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, Copyright by
        <a href="http://www.ANOM.in" target="_blank">ANOM.in</a>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.0.5" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }

  </script>
    
</body>
</html>