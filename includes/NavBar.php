<?php require_once 'dbconfig.php';?>

<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">



      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="view/acheter.php" target="_blank"> Acheter
              <span class="sr-only">(current) </span>
                <i class="fa fa-shopping-cart"></i>
            </a>
          </li>

            <li class="nav-item active">
                <a class="nav-link waves-effect" href="view/admin.php">Admin
                </a>
            </li>


            <li class="nav-item active">
                <a class="nav-link waves-effect" href="view/contact.php">Contact
                </a>
            </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect">

              Chiffre d'affaire de <span class="badge red z-depth-1 mr-1"> <?php echo $chiffreAffaire ?>TND</span>

             </button>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://www.facebook.com/mariem.hichri.31" class="nav-link waves-effect" target="_blank">
              <i class="fa fa-facebook"></i>
            </a>
          </li>

        </ul>

      </div>

    </div>
  </nav>