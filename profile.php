<?php
require_once './Controllers/donorController.php';
// require_once './Includes/functions.php';

// $allDistricts = getAllDistrictsData(["id", "name"]);
// $districts = "";
// foreach ($allDistricts as $dist) {
//   $districts .= "<option value='" . $dist["id"] . "'>" . ucfirst($dist["name"]) . "</option>";
// }


if( (int)$status)
{
  $label = '
  <div class="form-check form-check-inline d-flex justify-content-center">
    <label class="form-check-label" for="inlineRadio1">Available</label>
    <input class="form-check-input mx-4 bg-success" type="radio" name="inlineRadioOptions">
  </div>
  ';
  $option = '
  <option value="1" selected>Ready</option>
  <option value="0">Not Ready</option>
  ';
}else
{
  $label = '
  <div class="form-check form-check-inline d-flex justify-content-center">
    <label class="form-check-label ml-5" for="inlineRadio2">Not Available</label>
    <input class="form-check-input mx-4 bg-danger" type="radio" name="inlineRadioOptions">
  </div>
  ';

  $option = '
  <option value="1">Ready</option>
  <option value="0" selected>Not Ready</option>
  ';
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
  <style>
    #profile_img {
      width: 200px;
      height: 200px;
      background-color: #ccc;
    }
  </style>

</head>

<body>
      <?php include_once './Includes/navbar.php'; ?>


  <section style="background-color: light;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item active text-danger" aria-current="page">User Profile</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img id='profile_img' src="<?php echo $picture;  ?>" alt="avatar" class="rounded-circle img-fluid border border-danger" style="max-width: 100%;">
              <h5 class="my-3"><?php echo $firstName.' '.$lastName  ?></h5>
              <?php echo $label; ?>
            </div>
          </div>

        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $firstName.' '.$lastName  ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $email;  ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $phone;  ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Gender</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $gender;  ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Blood Type</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $bloodtype; ?></p>
                </div>
              </div>
              <hr/>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">District</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo ucfirst($district_val);; ?></p>
                </div>
              </div>
            <hr/>
            <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Availability</p>
                </div>
                <div class="col-sm-9">
                    <form method="POST" class="row">
                      <div class="col-sm-4">
                        <select name="availability" class="form-control">
                        <?= $option; ?>
                        </select>
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" name="updateStatus" class="btn btn-sm btn-primary">Update</button>
                      </div>
                    </form>
                </div>
              </div>
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