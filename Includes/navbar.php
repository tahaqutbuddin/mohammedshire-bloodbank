<nav class="navbar navbar-expand-md navbar-light bg-danger pt-3 pb-3">
  <div class="container">
    <!-- navbar brand / title -->
    <a class="navbar-brand" href="index.php">
      <span class="text-white fw-bold">
        <i class="bi bi-book-half"></i>
        Soobe Blood-Hub
      </span>
    </a>
    <!-- toggle button for mobile nav -->
    <button class="navbar-toggler rounded border border-success" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="bi bi-list-nested display-4"></i></span>
    </button>

    <!-- navbar links -->
    <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
      <ul class="navbar-nav ">
        <li class="nav-item ">
          <a class="nav-link text-white " href="./index.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="./search-donors.php">DONORS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="./contact.php">CONTACT US</a>
        </li>
        <li class="nav-item m-1">
          <a class="btn btn-danger border w-100" href="./registration.php"> SIGN UP
            <i class="bi bi-person-plus"></i>
            </a>
        </li>
        <li class="nav-item  d-md-inline m-1">
          <!-- <a class="btn btn-secondary" href="#pricing">buy nowss</a> -->
          <a class="btn btn-success btn-rounded w-100" data-bs-toggle="modal" data-bs-target="#modalLoginForm">
              Log In   <i class="bi bi-box-arrow-in-right"></i></a>
        </li>
        <!-- modal login form -->
      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form method="POST">
                  <div class="modal-header text-center">
                      <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body mx-3">
                      <div class="md-form mb-5">
                          <i class="fas fa-envelope prefix grey-text"></i>
                          
                          <label data-error="wrong" data-success="right" for="defaultForm-email">Email Address</label>
                          <input type="email" id="defaultForm-email" name="email" class="form-control validate">
                      </div>
      
                      <div class="md-form mb-4">
                          <i class="fas fa-lock prefix grey-text"></i>
                          
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                          <input type="password" id="defaultForm-pass" name="password" class="form-control validate">

                      </div>
      
                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                      <button class="btn btn-success w-100 d-block" type="submit" name="loginUser">
                          <a class="nav-link text-white">Log In</a> </button>
                  </div>
                </form>
              </div>
          </div>
      </div>
      <!-- end  modal form -->
        
      </ul>
    </div>
  </div>
</nav>
<!-- end nav bar  -->
