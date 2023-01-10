<?php 
require_once __DIR__.'/Controllers/donorController.php'; 


if( (!isset($_SESSION["adminid"])) )
{
  header("Location: login.php");
}

$allDistricts = getAllDistrictsData(["id","name"]);
$districts = "";
$districts .= "<option value='' selected>Select District</option>";
foreach ($allDistricts as $dist)
{
  $districts .= "<option value='".$dist["id"]."'>".ucfirst($dist["name"])."</option>";
}
?>

<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Add New Donor - Donors List</title>

    <meta name="description" content="" />

    <?php require_once './Includes/headerFiles.php'; ?>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <?php require_once './Includes/navbar.php'; ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                 
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
               

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="dropdown-item" href="logout.php">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
                  </a>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">

                <!-- Form controls -->
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="card mb-4">
                    <h5 class="card-header bg-primary text-white">Add New Donor</h5>
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <br/>

                      <?php 
                      if(isset($message) && (strlen($message)>0))
                      {
                        echo $message;
                      }
                      ?>

                      <div class="row justify-content-center">
                        <div class="col-6">
                          <div>
                            <label for="defaultFormControlInput" class="form-label">Donor Id</label>
                            <input type="text" value="<?= $id; ?>" class="form-control" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" readonly>
                          </div>
                        </div>
                      </div>
                      <br/>
                        

                      <div class="row">
                        <div class="col-6">
                          <div>
                            <label for="defaultFormControlInput" class="form-label">First Name</label>
                            <input type="text" name="firstName" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp" required>
                          </div>
                        </div>
                        <div class="col-6">
                          <div>
                            <label for="defaultFormControlInput" class="form-label">Last Name</label>
                            <input type="text" name="lastName" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp" required>
                          </div>
                        </div>
                      </div>
                      
                      <br/>
                      <div class="row">
                        <div class="col-12">
                          <div>
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                          </div>
                        </div>
                      </div>

                      <br/>
                      <div class="row">
                        <div class="col-6">
                          <div>
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="********" required>
                          </div>
                        </div>
                        <div class="col-6">
                          <div>
                            <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" id="exampleFormControlInput1" placeholder="********" required>
                          </div>
                        </div>
                      </div>
                      
                      <br/>

                      <div class="row">
                        <div class="col-6">
                          <div>
                            <label for="exampleFormControlInput1" class="form-label">Contact No</label>
                            <input type="text" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="e.g +92331879608" required>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="col-md">
                            <label for="exampleFormControlInput1" class="form-label">Gender</label><br/>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" checked>
                              <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                              <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <br/>

                      <div class="row">
                        <div class="col-6">
                          <div>
                            <label for="exampleFormControlSelect1" class="form-label">Districts</label>
                            <select class="form-select" name="district" id="exampleFormControlSelect1" aria-label="Default select example" required>
                              <?= $districts; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <div>
                            <label for="exampleFormControlSelect1" class="form-label">Blood Type</label>
                            <select class="form-select" name="bloodtype" id="exampleFormControlSelect1" aria-label="Default select example" required>
                              <option selected value="">Select Blood Type</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                              <option value="AB-">AB-</option>
                              <option value="AB+">AB+</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <br/>

                      <div>
                        <label for="formFile" class="form-label">Profile Picture</label>
                        <input class="form-control" name="image" type="file" id="formFile" required>
                      </div>
        
                      <div class="row mt-3">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                          <button type="submit" name="insertDonor" class="btn btn-primary btn-lg" >Store Details</button>
                        </div>
                      </div>

                    </form>


                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <?php require_once './Includes/footerFiles.php'; ?>


  </body>
</html>
