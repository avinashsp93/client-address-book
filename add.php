<!--Adding Clients Page-->


<?php
    
    session_start();    // start the session to store the information of the user logging in.

    // redirect to login page if the session doesn't have a user
    if(!$_SESSION['loggedInUser']) {
        header('location: index.php');
    }

    // php script required to connect to database
    include('includes/connection.php');

    // php script required to validate form data
    include('includes/functions.php');

    // declaring the necessary variables
    $clientName = $clientEmail = $clientPhone = $clientAddress = $clientCompany = $clientNotes = '';

    // will be executed when the user hits Add Client button
    if(isset($_POST['client-add'])) {

        // empty field validation
        if(!$_POST['clientName']) {
            $nameError = "Please enter a name <br>";
        } else {
            $clientName = validateFormData($_POST['clientName']);
        }

        if(!$_POST['clientEmail']) {
            $nameError = "Please enter an email <br>";
        } else {
            $clientEmail = validateFormData($_POST['clientEmail']);
        }       

        // populating the variables with validated data that can be written to the database
        $clientAddress = validateFormData($_POST['clientAddress']);
        $clientPhone = validateFormData($_POST['clientPhone']);
        $clientCompany = validateFormData($_POST['clientCompany']);
        $clientNotes = validateFormData($_POST['clientNotes']);


        if($clientName && $clientEmail) {
            // create query to write the form contents to the database
            $query = "INSERT INTO clients (id, name, email, phone, address, company, notes, date_added)
                        VALUES (NULL, '$clientName', '$clientEmail', '$clientPhone', '$clientAddress', '$clientCompany', '$clientNotes', CURRENT_TIMESTAMP)";
            // store the result after the query is executed
            $result = mysqli_query($conn, $query);

            // check if the query was successful, if so redirect to the Clients page else display error message
            if($result) {
                header('location: clients.php?alert=createsuccess');
            } else {
                echo "error: ".$query. "<br>" .mysqli_error($conn);
            }
        }
           
    }
    // close the mysql connection to avoid accidental database changes
    mysqli_close($conn);

    // all we need to display the page header
    include('includes/header.php');
?>

<div class="container">
    <h1>Add Client</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="row">
        <div class="form-group col-sm-6">
            <label for="client-name">Name *</label>
            <input class="form-control" type="text" placeholder="Name" id="client-name" name="clientName"/>
        </div>
        <div class="form-group col-sm-6">
            <label for="client-email">Email</label>
            <input class="form-control" type="email" placeholder="Email" id="client-email" name="clientEmail"/>
        </div>
        <div class="form-group col-sm-6">
            <label for="client-phone">Phone</label>
            <input class="form-control" type="text" placeholder="Phone" id="client-phone" name="clientPhone"/>
        </div>
        <div class="form-group col-sm-6">
            <label for="client-address">Address</label>
            <input class="form-control" type="text" placeholder="Address" id="client-address" name="clientAddress"/>
        </div>
        <div class="form-group col-sm-6">
            <label for="client-company">Company</label>
            <input class="form-control" type="text" placeholder="Company" id="client-company" name="clientCompany"/>
        </div>
        <div class="form-group col-sm-6">
            <label for="client-notes">Notes</label>
            <input class="form-control" type="text" placeholder="Notes" id="client-notes" name="clientNotes"/>
        </div>
        <div class="col-sm-12">
            <a href="clients.php" class="btn btn-default">Cancel</a>
            <button type="submit" name="client-add" class="btn btn-primary">Add Client</button></button>
        </div>
    </form>
</div>

<?php 
    // all we need to display the page footer
    include('includes/footer.php');
?>