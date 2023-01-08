  <!-- Menu -->
  
  <?php
  $directoryURI = $_SERVER['REQUEST_URI'];
  $path = parse_url($directoryURI, PHP_URL_PATH);
  $components = explode('/', $path);
  $first_part = $components[count($components)-1];
?>

<?php 
if(isset($_SESSION["adminid"]))
{ 
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.php" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item <?php if($first_part == "index.php"){echo "active";} ?>">
        <a href="index.php" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <!-- Clients -->
      <li class="menu-item <?php if($first_part == "addDonor.php" || $first_part == "allDonors.php" || $first_part == "editDonor.php"){echo "open";}  ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Donors</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item <?php if($first_part == "addDonor.php"){echo "active";} ?>">
            <a href="addDonor.php" class="menu-link">
              <div data-i18n="Analytics">Add New Donor</div>
            </a>
          </li>

          <li class="menu-item <?php if($first_part == "allDonors.php"){echo "active";} ?>">
            <a href="allDonors.php" class="menu-link">
              <div data-i18n="Analytics">All Donors</div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
</aside>

<?php 
} 
?>
        <!-- / Menu -->