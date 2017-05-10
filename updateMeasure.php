<?php
include 'header.php';
?>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Customer Measurements - Edit</h1>
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
    $query = "SELECT id, lastname, firstname, neck, shoulder, chest FROM customers WHERE id = ? LIMIT 0,1";
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
    $neck = $row['neck'];
    $shoulder = $row['shoulder'];
    $chest = $row['chest'];
    $image = htmlspecialchars($row['image'], ENT_QUOTES);
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
        $query = "UPDATE customers 
                    SET neck=:neck, shoulder=:shoulder, chest=:chest 
                    WHERE id =:id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        //$lastname=htmlspecialchars(strip_tags($_POST['lastname']));
        //$firstname=htmlspecialchars(strip_tags($_POST['firstname']));
        $neck=htmlspecialchars(strip_tags($_POST['neck']));
        $shoulder=htmlspecialchars(strip_tags($_POST['shoulder']));
        $chest=htmlspecialchars(strip_tags($_POST['chest']));
 
        // bind the parameters (should be same variables as posted values plus $id)
        $stmt->bindParam(':neck', $neck);
        $stmt->bindParam(':shoulder', $shoulder);
        $stmt->bindParam(':chest', $chest);
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
            <td><?php echo htmlspecialchars($lastname, ENT_QUOTES);  ?></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?php echo htmlspecialchars($firstname, ENT_QUOTES);  ?></td>
        </tr>
        <tr>
            <td>Neck</td>
            <td><input type='text' name='neck' value="<?php echo htmlspecialchars($neck, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Shoulder</td>
            <td><input type='text' name='shoulder' value="<?php echo htmlspecialchars($shoulder, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Chest</td>
            <td><input type='text' name='chest' value="<?php echo htmlspecialchars($chest, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
        <td>Waist</td>
        <td></td>
    </tr>
    <tr>
        <td>Hips</td>
        <td></td>
    </tr>
    <tr>
        <td>Sleeve</td>
        <td></td>
    </tr>
        <tr>
            <td><input type='submit' value='Save Changes' class='btn btn-primary' /></td>
            <td>
                <a href='index.php' class='btn btn-danger'>Back to All Customers</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
 
</body>
</html>