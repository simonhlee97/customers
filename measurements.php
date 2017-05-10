<?php
include 'header.php';
?>
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Customer Measurements - View</h1>
        </div>
         
        <!-- dynamic content will be here -->
        <?php
// get passed parameter value, in this case, $id = measurements.id
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
        <td>First Name</td>
        <td><?php echo htmlspecialchars($firstname, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Neck</td>
        <td><?php echo htmlspecialchars($neck, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Shoulder</td>
        <td><?php echo htmlspecialchars($shoulder, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Chest</td>
        <td><?php echo htmlspecialchars($chest, ENT_QUOTES);  ?></td>
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
        <td><?php echo "<a href='updateMeasure.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>"; ?>
        <td>
            <a href='index.php' class='btn btn-danger'>Back to All Customers</a>
        </td>
    </tr>
</table>
 
    </div> <!-- end .container -->
 
</body>
</html>