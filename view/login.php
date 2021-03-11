<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/login.css">
    <title>PSITS | Institute of Computer Studies</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg">
            <div class="header">
                <a href="login.php"><img src="../assets/ics.png" alt="ICSLOGO"></a>
                <span class="navbar-text header-ics">Institute of Computer Studies</span>
            </div>
        </nav>
    </div>
    
    <!--Center-->
    <div class="container">
        <div class="row">
            <form>
                <div id="loginMenu">
                    <div class="headerimg animate__animated animate__bounce mb-3">
                        <div class="row mt-3">
                            <img src="../assets/male.png" alt="male" class="mt-3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="studentid">Email address</label>
                        <input type="email" class="form-control" id="studentid" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <p>Don't have an account? <a href="process_registration.php" class="reg">Register here.</a></p>
                        </div>
                        <div class="row">
                            <a href="#" class=" btn btn-success "id="showToast">Sign in</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <nav class="navbar fixed-bottom">
            <span class="navbar-text footer">PSITS | Institute of Computer Studies 2020</span>
        </nav>
    </footer>
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>
</html>