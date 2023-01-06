<?php 
require_once './Controllers/loginController.php';
if( (isset($_SESSION["userid"])) )
{
  // header("Location:./loginf.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php require_once './Includes/headerFiles.php'; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
</head>
<body>

   <?php require_once './Includes/navbar.php'; ?>

    <!-- hero section start here -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 text-center text-md-start">
                    <h1>
                      <div class="display-1 text-danger">Blood-Hub</div>
                      <div class="display-5 text-muted">MAKE IT EASY</div>
                    </h1>
                    <p class="lead my-4 text-muted">TO MAKE IT EASY PLEASY REGISTER YOUR INFORMATION , BE A DONOR  , THERE ARE MANY PEOPLE OUR PEOPLE NEED PLOOD  THANKS</p>
                    <a href="search-donors.php" class="btn btn-secondary btn-lg bg-danger border">SEARCH DONORS</a>
                    <!-- open sidebar / offcanvas -->
                    <a href="registration.php" class="d-block mt-3">
                      Register - Please
                    </a>
                  </div>
                <div class="col-md-6">
                    <img src="img/panner.png" alt="">
                </div>
            </div>
        </div>
    </div>


    <!-- footer start here -->

    <footer class="bg-danger text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
          <!-- Section: Form -->
          <section class="">
            <form action="">
              <!--Grid row-->
              <div class="row d-flex justify-content-center">
                <!--Grid column-->
                <div class="col-auto">
                  <p class="pt-2">
                    <strong>Sign up for our newsletter</strong>
                  </p>
                </div>
                <!--Grid column-->
      
                <!--Grid column-->
                <div class="col-md-5 col-12">
                  <!-- Email input -->
                  <div class="form-outline form-white mb-4">
                    <input type="email" id="form5Example29" class="form-control" />
                    <label class="form-label" for="form5Example29">Email address</label>
                  </div>
                </div>
                <!--Grid column-->
      
                <!--Grid column-->
                <div class="col-auto">
                  <!-- Submit button -->
                  <button type="submit" class="btn btn-outline-light mb-4">
                    Subscribe
                  </button>
                </div>
                <!--Grid column-->
              </div>
              <!--Grid row-->
            </form>
          </section>
          <!-- Section: Form -->
        </div>
        <!-- Grid container -->
      
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(114, 11, 11, 0.2);">
          © 2022 Copyright:
          <a class="text-white" href="index.php">Soobe Blood-Hub</a>
        </div>
        <!-- Copyright -->
      </footer>


    <!-- footer end here -->
    
</body>

<?php require_once './Includes/footerFiles.php'; ?>
</html>