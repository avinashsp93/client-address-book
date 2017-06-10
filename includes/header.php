<!--Header Markup-->


<title>Client Manager</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="clients.php">CLIENTS<strong>MANAGER</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <?php 
                // display the below logout markup in the header if the session globals still has the user
                if(isset($_SESSION['loggedInUser'])) {
                    if($_SESSION['loggedInUser']) {
            ?>
            <ul class="nav navbar-nav">
                <li><a href="clients.php">My Clients</a></li>
                <li><a href="add.php">Add Client</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text">Welcome <strong>Avinash</strong></p>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <?php
                    } else {
            ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="clients.php">Login</a></li>
                </ul>
            <?php
                    }
                // display the below login markup in the
                } else {
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="clients.php">Login</a></li>
            </ul>
            <?php
                }
            ?>
        </div>
    </div>
</nav>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
