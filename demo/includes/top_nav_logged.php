<nav class="navbar navbar-expand-lg navbar-light bg-white ">
        <a class="navbar-brand" href="index.php"><img class="logo" src="assets/logo.svg" alt="ART Travels"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo ($page == 'home') ? "active" : ""; ?> ">
                    <a class="nav-link" href="index.php">Book ticket <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php echo ($page == 'home') ? "active" : ""; ?>">
                    <a class="nav-link" href="view_ticket.php">Print/Send/Download ticket</a>
                </li>
                <li class="nav-item <?php echo ($page == 'home') ? "active" : ""; ?>">
                    <a class="nav-link" href="cancel_ticket.php">Cancel ticket</a>
                </li>
                <li class="nav-item <?php echo ($page == 'home') ? "active" : ""; ?>">
                    <a class="nav-link" href="change_boarding.php">Change boarding point</a>
                </li>
             <li class="nav-item dropdown <?php echo ($page == 'history')||($page == 'profile') ||($page == 'password')? "active" : ""; ?>">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Welcome Kamalakannan!
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="my_account.php">Ticket history</a>
          <a class="dropdown-item" href="my_profile.php">My profile</a>
          <a class="dropdown-item" href="my_password.php">Change password</a>
        </div>
      </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="sign_in.php">Sign Out  </a>
                </li>

            </ul>
        </div>
    </nav>