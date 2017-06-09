<?php

    // This page has some issues and is still under construction....

    session_start();
    session_unset();

    session_destroy();   
    

    if( isset($_COOKIE[session_name()])) {

        setcookie( session_name(), '', time()-86400, '/');
    }

    include('includes/header.php');

    
?>

<div class="container">
    <h1>Logged out</h1>
    <p class="lead">You've been logged out. <a href="index.php">Click here</a> to login</p>
</div>

<?php
    include('includes/footer.php');
?>