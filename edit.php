<?php

    session_start(); // start the session to grab all the session locals used

    if(!$_SESSION['loggedInUser']) {    // if the session doesn't have any logged in user redirect to login page
        header("location: index.php"); 
    }

    // empty variable declaration
    $alertMessage = '';
    $clientID = $_GET['id'];

    // include the functionality for validating form data
    include('includes/functions.php');

    // include the functionality to connect to the database
    include('includes/connection.php');

    // query to select a particular client that needs to be edited
    $query = "SELECT * FROM clients where id='$clientID'";
    $result = mysqli_query($conn, $query);

    // if the query resulted fetched any rows
    if( mysqli_num_rows($result) > 0 ) {
        // iterate through the entire rows fetched and store each rows in $row
        while($row = mysqli_fetch_assoc($result)) {
            // populate all the indivudual elements of a row in variables
            $clientName = $row['name'];
            $clientEmail = $row['email'];
            $clientPhone = $row['phone'];
            $clientAddress = $row['address'];
            $clientCompany = $row['company'];
            $clientNotes = $row['notes'];
        }
    }
    else {
            // else if the query did not fetch any rows, alert the user
        $alertMessage = "<div class='alert alert-warning'>Nothing to see here!<a href='clients.php'>Head Back</a></div>";
    }

    // if the user clicks on update client button

    if(isset($_POST['client-update'])) {

        // refine the data entered with all the validation so that it can be written to database
        $clientName = validateFormData($_POST['clientName']);
        $clientEmail = validateFormData($_POST['clientEmail']);
        $clientCompany = validateFormData($_POST['clientCompany']);
        $clientAddress = validateFormData($_POST['clientAddress']);
        $clientPhone = validateFormData($_POST['clientPhone']);
        $clientNotes = validateFormData($_POST['clientNotes']);

        // query to update client with the given id
        $query = "UPDATE clients SET name='$clientName', email='$clientEmail', address='$clientAddress', phone='$clientPhone',
                    company='$clientCompany', notes='$clientNotes' WHERE id='$clientID'";
        $result = mysqli_query($conn, $query);

        // if the query was successful
        if($result) {
            // redirect to the clients page with query string else throw error
            header("location: clients.php?alert=updatesuccess");
        } else {
            echo "Error updating the record : " . mysqli_error($conn);
        }
    }

    // if the user clicks on YES on the alert when asked to delete a user
    if(isset($_POST['confirm-delete'])) {

        // query to delete a user who's being edited
        $query = "DELETE FROM clients WHERE id='$clientID'";
        $result = mysqli_query($conn, $query);

        // if the query ran successfully, headback to client saying delete success, else throw an alert
        if($result) {
            header("location: clients.php?alert=deletesuccess");
        } else {
            echo "Error deleting the record : " . mysqli_error($conn);
        }

    }

    // when user clicks on delete button
    if(isset($_POST['client-delete'])) {
        
        // alert modal to confirm user whether to really delete the user from the database or not
        $alertMessage = "<div class='alert alert-danger'>
                            <p>Are you sure you want to delete?</p>
                            <form action='". htmlspecialchars($_SERVER['PHP_SELF']) ."?id=$clientID' method='post'>
                                <button type'submit' class='btn btn-primary btn-sm' name='confirm-delete'>Yes</button>
                                <a class='btn btn-default btn-sm' data-dismiss='alert'>No</a>
                            </form>
                        </div>";
        
    }    

    // all we need to show header
    include('includes/header.php');
?>

<div class="container">
    <h1>Edit Client</h1>

    <?php echo $alertMessage;?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?id=<?php echo $clientID;?>" method="post" class="row">
        <div class="form-group col-sm-6">
            <label for="client-name">Name *</label>
            <input class="form-control" type="text" placeholder="Name" id="client-name" name="clientName" value="<?php echo $clientName; ?>" />
        </div>
        <div class="form-group col-sm-6">
            <label for="client-email">Email</label>
            <input class="form-control" type="email" placeholder="Email" id="client-email" name="clientEmail" value="<?php echo $clientEmail; ?>" />
        </div>
        <div class="form-group col-sm-6">
            <label for="client-phone">Phone</label>
            <input class="form-control" type="text" placeholder="Phone" id="client-phone" name="clientPhone" value="<?php echo $clientPhone; ?>" />
        </div>
        <div class="form-group col-sm-6">
            <label for="client-address">Address</label>
            <input class="form-control" type="text" placeholder="Address" id="client-address" name="clientAddress" value="<?php echo $clientAddress; ?>" />
        </div>
        <div class="form-group col-sm-6">
            <label for="client-company">Company</label>
            <input class="form-control" type="text" placeholder="Company" id="client-company" name="clientCompany" value="<?php echo $clientCompany; ?>" />
        </div>
        <div class="form-group col-sm-6">
            <label for="client-notes">Notes</label>
            <input class="form-control" type="text" placeholder="Notes" id="client-notes" name="clientNotes" value="<?php echo $clientNotes; ?>" />
        </div>
        <div class="col-sm-12">
            <hr>
            <button class="btn btn-danger pull-left" name="client-delete">Delete</button>
            <div class="pull-right">
                <a href="clients.php" class="btn btn-default">Cancel</a>
                <button type="submit" name="client-update" class="btn btn-success">Update Client</button>
            <div>
        </div>
    </form>
</div>