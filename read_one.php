<?php
include 'header.php';
?>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Customer - Contact Info</h1>
        </div>
         
        <!-- dynamic content will be here -->
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT id, lastname, firstname, email, phone, address, city, zip FROM products WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $lastname = $row['lastname'];
    $firstname = $row['firstname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $city = $row['city'];
    $zip = $row['zip'];
    $image = htmlspecialchars($row['image'], ENT_QUOTES);
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
<!--we have our html table here where new user information will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Last Name</td>
        <td><?php echo htmlspecialchars($lastname, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>First Name</td></td>
        <td><?php echo htmlspecialchars($firstname, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo htmlspecialchars($email, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><?php echo htmlspecialchars($phone, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo htmlspecialchars($address, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>City</td>
        <td><?php echo htmlspecialchars($city, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Zip</td>
        <td><?php echo htmlspecialchars($zip, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Image</td>
        <td><?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "No image found.";  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-danger'>Back to All Customers</a>
        </td>
    </tr>
</table>
 
    </div> <!-- end .container -->
 
</body>
</html>