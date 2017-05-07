<?php
include 'header.php';
?>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Edit and Update Customer Details</h1>
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
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'database.php';
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE products 
                    SET lastname=:lastname, firstname=:firstname, email=:email, phone=:phone, address=:address, city=:city, zip=:zip 
                    WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $lastname=htmlspecialchars(strip_tags($_POST['lastname']));
        $firstname=htmlspecialchars(strip_tags($_POST['firstname']));
        $email=htmlspecialchars(strip_tags($_POST['email']));
        $phone=htmlspecialchars(strip_tags($_POST['phone']));
        $address=htmlspecialchars(strip_tags($_POST['address']));
        $city=htmlspecialchars(strip_tags($_POST['city']));
        $zip=htmlspecialchars(strip_tags($_POST['zip']));
 
        // bind the parameters (should be same variables as posted values plus $id)
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':zip', $zip);
        //$stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!--we have our html form here where new user information will be entered-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lastname' value="<?php echo htmlspecialchars($lastname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><input type='text' name='firstname' value="<?php echo htmlspecialchars($firstname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Email Name</td>
            <td><input type='text' name='email' value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type='text' name='phone' value="<?php echo htmlspecialchars($phone, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type='text' name='address' value="<?php echo htmlspecialchars($address, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type='text' name='city' value="<?php echo htmlspecialchars($city, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Zip</td>
            <td><input type='text' name='zip'  value="<?php echo htmlspecialchars($zip, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to All Customers</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
 
</body>
</html>