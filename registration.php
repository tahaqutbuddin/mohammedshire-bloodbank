<?php
require_once './Controllers/donorController.php';
require_once './Includes/functions.php';

$allDistricts = getAllDistrictsData(["id","name"]);
$districts = "";
foreach ($allDistricts as $dist)
{
  $districts .= "<option value='".$dist["id"]."'>".ucfirst($dist["name"])."</option>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
</head>
<body>

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
                <a class="nav-link text-white " href="index.php">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="search-donors.php">DONORS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">CONTACT US</a>
              </li>
              <li class="nav-item m-1">
                <a class="btn btn-danger border w-100" href="registration.php"> SIGN UP
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
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <input type="email" id="defaultForm-email" class="form-control validate">
                                <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
                            </div>
            
                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" id="defaultForm-pass" class="form-control validate">
                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                            </div>
            
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-success w-100 d-block">
                                <a class="nav-link text-white" href="#contact">Log In</a> </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end  modal form -->
              
            </ul>
          </div>
        </div>
      </nav>
    <!-- end nav bar  -->

    <!-- form start here -->
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
              <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-1">Registration Form</h3>
                  <form method="POST" enctype="multipart/form-data">
      
                    <div class="row">
                      <div class="col-md-6 mb-1">
      
                        <div class="form-outline">
                          <label class="form-label" for="firstName">First Name</label>
                          <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" required />
                        </div>
      
                      </div>
                      <div class="col-md-6 mb-1">
      
                        <div class="form-outline">
                          <label class="form-label" for="lastName">Last Name</label>
                          <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" required />
                        </div>
      
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="emailAddress">Email</label>
                            <input type="email" id="emailAddress" name="email" class="form-control form-control-lg" required />
                          </div>
        
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <input type="tel" id="phoneNumber" name="phone" class="form-control form-control-lg" required/>
                          </div>
        
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-1 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="">Password</label>
                            <input type="text" id="password" name="password" class="form-control form-control-lg" required />
                          </div>
        
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="">Confirm Password</label>
                            <input type="text" id="cpassword" name="cpassword" class="form-control form-control-lg" required/>
                          </div>
        
                        </div>
                      </div>
      
                    <div class="row">
                      <div class="col-md-6 mb-4 d-flex align-items-center">
      
                        <div class="form-outline datepicker w-100">
                          <label for="birthdayDate" class="form-label">Picture</label>
                          <input type="file" name="image" class="form-control form-control-lg" id=""/>
                        </div>
      
                      </div>
                      <div class="col-md-6 mb-4">
      
                        <h6 class="mb-2 pb-1">Gender: </h6>
      
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                            value="female" checked required/>
                          <label class="form-check-label" for="femaleGender">Female</label>
                        </div>
      
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="maleGender"
                            value="male" required/>
                          <label class="form-check-label" for="maleGender">Male</label>
                        </div>
      
                      </div>
                    </div>
      
      
                    <div class="row">
                      <div class="col-6">
      
                      <label class="form-label select-label">Blood Type</label>  
                        <select class="select form-control-lg" name="bloodtype" required>
                          <option value="">Select Blood Type</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="B-">B-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                        </select>
      
                      </div>
                      <div class="col-6">
                        <label class="form-label select-label">District</label>
                        <select class="select form-control-lg" name="district" required>
                          <option value="">Select your District</option>
                          <?= $districts; ?>
                        </select>
                        
      
                      </div>
                    </div>
      
                    <div class="mt-4 pt-2">
                      <input class="btn btn-success btn-lg" type="submit" name="insertDonor" value="Registration" />
                    </div>
      
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



    
</body>

<script src="./assets/js/popper.js"></script>
<script src="./assets/js/boostrap.js"></script>
</html>