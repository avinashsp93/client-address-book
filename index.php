<!--Login Page-->


<?php

    session_start();        // start the session to store the information of the user logging in.
    include('includes/functions.php');      // php script required to validate form data
    
    // variable declaration and initialization
    $loginError = '';
    $formEmail = '';
    $_SESSION['loggedInUser'] = ''; // Session global

    // will be executed when the user hits login button
    if(isset($_POST['login'])) {

        // create database and wrap up by validating the data

        $formEmail = validateFormData($_POST['login-email']);
        $formPass = validateFormData($_POST['login-password']);

        // php script required to connect to database

        include('includes/connection.php');

        // create query to fetch the name, password of the entered emailid
        $query = "SELECT name, password FROM users WHERE email = '$formEmail'";
        
        // store the result after the query is executed
        $result = mysqli_query($conn, $query);

        // check if the query has fetched any rows
        if(mysqli_num_rows($result) > 0) {

            //store the result row as an array
            while($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
                $hashedPass = $row['password'];

                // authenticate hashed password and the entered password
                if(password_verify($formPass, $hashedPass)) {
                    $_SESSION['loggedInUser'] = $name;

                    header('location: clients.php');    // open clients.php
                }
                else {
                    // error message stored as a markup and displayed if the password is not verified
                    $loginError = "<div class='alert alert-danger'>Bad username/password</div>";
                }
            }

        }
        else {
            // error message stored as a markup and displayed if the username is not found in the database
            $loginError = "<div class='alert alert-danger'>No such user found in the database <a class='close' data-dismiss='alert'>&times;</a></div>";
        }

        // close the mysql connection to avoid accidental database changes
        mysqli_close($conn);
    }
    
    // all we need to display the page header
    include('includes/header.php');
?>

<div class="container">

    <h1>Client Address Book</h1>
    <p class="lead">Login to your account</p>

    <div><?php echo $loginError; ?></div>

    <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label for="login-email">Email</label>
            <input class="form-control" type="email" name="login-email" id="login-email" placeholder="Email Address" value="<?php echo $formEmail;?>"/>
        </div>
        <div class="form-group">
            <label for="login-password">Password</label>
            <input class="form-control" type="password" name="login-password" id="login-password" placeholder="Password" />
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
    </form>
    <br><hr>
    <?php
        // all we need to display the page footer
        include('includes/footer.php');
    ?>

</div>

