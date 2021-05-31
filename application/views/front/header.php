  <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block"> 
            <a href="tel:918949534195" class="small mr-3"><span class="icon-phone2 mr-2"></span> +918949534195</a> 
            <a href="mailto:anomtechnology@gmail.com" class="small mr-3"><span class="icon-envelope-o mr-2"></span> anomtechnology@gmail.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="<?php echo base_url(); ?>login" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
            <a href="<?php echo base_url(); ?>register" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
          </div>
        </div>
      </div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="<?php echo base_url(); ?>" class="d-block">
              <img src="<?php echo base_url(); ?>front/images/logo.png" alt="Image" style="height: 50px;" class="img-fluid">
            </a>
          </div>
          <div class="mr-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active">
                  <a href="<?php echo base_url(); ?>" class="nav-link text-left">Home</a>
                </li>
                <li class="has-children">
                  <a href="<?php echo base_url(); ?>about" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="<?php echo base_url(); ?>teacher">Our Teachers</a></li>
                    <li><a href="<?php echo base_url(); ?>school">Our School</a></li>
                  </ul>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>schools" class="nav-link text-left">Schools</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>course" class="nav-link text-left">Courses</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>contact" class="nav-link text-left">Contact</a>
                  </li>
              </ul>
            </nav>

          </div>
          <div class="ml-auto">
            <div class="social-wrap">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>

              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
            </div>
          </div>
         
        </div>
      </div>

    </header>