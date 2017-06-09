<?php
// declare empty variables
$query = $result = $alertMessage = '';

session_start();    // start the session to retrieve the logged in user

// check if there's a logged in user, if not redirect to login page
if(!$_SESSION['loggedInUser']) {
    header("location: index.php");
}

// php script required to connect to database
include('includes/connection.php');

// query to retrieve all the clients to populate the table
$query = "SELECT * FROM clients";

// result after running the query
$result = mysqli_query( $conn, $query );

// check for the url parameter, if there's any key named alert, if so then check for its value
// if value is success then display alert saying New Client Added
// if value is updatesuccess then display alert saying Client Updated
// if value is deletesuccess then display alert saying Client Deleted

if(isset($_GET['alert'])) {
    if($_GET['alert'] == 'createsuccess') {
        $alertMessage = "<div class='alert alert-success'>New client added! <a class='close' data-dismiss='alert'>&times;</a> </div>";
    }
    elseif($_GET['alert'] == 'updatesuccess') {
        $alertMessage = "<div class='alert alert-success'>Client updated! <a class='close' data-dismiss='alert'>&times;</a> </div>";
    }
    elseif($_GET['alert'] == 'deletesuccess') {
        $alertMessage = "<div class='alert alert-success'>Client deleted! <a class='close' data-dismiss='alert'>&times;</a> </div>";
    }
}

// all we need to display header
include('includes/header.php');

?>

<div class="container">

    <h1>Client Address Book</h1>
    <?php echo $alertMessage; ?>
    <table class="table table-bordered table-striped">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Company</th>
            <th>Notes</th>
            <th>Edit</th>
        </thead>
        <tbody>
            <?php 
                //if the query returned any rows, then design a table in php to accomodate all the retrieved rows dynamically

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $address = $row['address'];
                        $company = $row['company'];
                        $notes = $row['notes'];
                        $date_added = $row['date_added'];
                        echo "<tr>";
                        echo "<td>" . $row['name'] . 
                            "</td><td>" . $row['email'] . 
                            "</td><td>" . $row['phone'] .
                            "</td><td>" . $row['address'] .
                            "</td><td>" . $row['company'] .
                            "</td><td>" . $row['notes'] .
                            "</td><td>";

                        // edit button that redirects to the edit.php page by sending url paramenter with the row id

                        echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-edit"/>
                            </a>';
                            
                        echo "</td>";
                        
                    }
                } else {
                    // else if the query returned zero rows, display this alert message
                    echo "<div class='alert alert-warning'>You have no clients!</div>";
                }

                // close the connection to avoid any accidental database changes
                mysqli_close( $conn );
            ?>
        </tbody>
    </table>
        <div class="text-center">
            <a href="add.php" type="button" class="btn btn-md btn-success">
                <span class="glyphicon glyphicon-plus"></span> Add Client
            </a>
        </div>

</div>