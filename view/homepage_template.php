<nav class="navbar navbar-expand-lg sticky-top">
    <div class="header">
        <a href="homepage.php"><img src="../assets/ics.png" alt="ICSLOGO"></a>
        <span class="navbar-text ics">Institute of Computer Studies</span>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i class="fas fa-bars"></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav dropdown ml-auto">
            <li class="nav-item ">
                <a class="nav-link" href="homepage.php"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money-bill"></i> Payment
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="fa fa-credit-card"></i> Payment</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-id-card"></i> Promissory</a>
                </div>
                
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="bell"><i class="fa fa-bell"></i> Notification</a>
            </li>
            <li class="nav-item dropdown">
                <?php if($_SESSION['first_name']): ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-alt"></i> Hi, 
                    <?php echo $_SESSION['first_name']; ?>
                </a>
                <?php endif; ?>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left: -2rem;">
                    <a class="dropdown-item" href="user_profile.php"><i class="fa fa-id-badge"></i> User Profile</a>
                    <a class="dropdown-item" href="login.php?logout=1"><i class="fa fa-sign-out-alt"></i> Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>