    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?php base_url(); ?>front/images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Login</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Login</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="<?php base_url(); ?>Login/ajax_login" method="post">
                    <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="email" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="pword">Password</label>
                                <input type="password" name="password" id="pword" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="submit" value="Log In" class="btn btn-primary btn-lg px-5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            

          
        </div>
    </div>