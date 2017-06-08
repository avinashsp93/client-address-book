<?php

    // This page has some issues and is still under construction....

    session_start();
    include('includes/header.php');
    

    if( isset($_COOKIE[session_name()])) {

        setcookie( session_name(), '', time()-86400, '/');
    }

    session_unset();

    session_destroy();   

    
?>

<div class="container">
    <h1>Logged out</h1>
    <p class="lead">You've been logged out. <?php echo $_SESSION['loggedInUser'];?></p>
</div>

<?php
    include('includes/footer.php');
?>