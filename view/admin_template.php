    <!-- ADMIN NAVBAR TEMPLATE -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="header">
            <a href="dashboard.php"><img src="../assets/ics.png" alt="icslog"></a>
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
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Fees
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navdropdown">
                        <a class="nav-link" href="#"><i class="fa fa-file-text"></i> Promissory</a>
                        <a class="nav-link" href="fees.php"><i class="fa fa-money-check"></i> Create fees</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Management
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navdropdown">
                        <a class="nav-link" href="account_approval.php"><i class="fa fa-users"></i> Approval</a>
                        <a class="nav-link" href="active_users.php"><i class="fa fa-user-circle"></i> Active User</a>
                        <a class="nav-link" href="manage_fees.php"><i class="fa fa-tasks"></i> Manage Fees</a>
                        <a class="nav-link" href="withdraw.php"><i class="fa fa-bank"></i> Manage Withdraw</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      School
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navdropdown">
                        <a class="nav-link" href="walkin_user.php"><i class="fa fa-user-alt"></i> Add User</a>
                        <a class="nav-link" href="school_year.php"><i class="fa fa-calendar-alt"></i> Add School year</a>
                        <a class="nav-link" href="year_lvl.php"><i class="fa fa-calendar-alt"></i> Add Year level</a>
                        <a class="nav-link" href="semester.php"><i class="fa fa-plus-square"></i> Add Semester</a>
                        <a class="nav-link" href="course.php"><i class="fa fa-chalkboard"></i> Add Course</a>
                        <a class="nav-link" href="section.php"><i class="fa fa-pen-square"></i> Add Section</a>
                        <a class="nav-link" href="announcement.php"><i class="fa fa-bullhorn"></i> Add Announcement</a>  
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <?php if($_SESSION['usertype']): ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-alt"></i> Welcome, 
                            <?php echo $_SESSION['usertype']; ?>
                        </a>
                    <?php endif; ?>
                    <div class="dropdown-menu sign-out" aria-labelledby="navdropdown">
                        <a class="nav-link" href="login.php?logout=1"><i class="fa fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
