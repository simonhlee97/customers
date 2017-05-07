<?php
include 'header.php';
?>
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View All Customers</h1>
        </div>
     
    <!-- dynamic content will be here -->
    <?php
// include database connection
include 'database.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
 
// select all data
$query = "SELECT id, lastname, firstname, email, phone FROM products ORDER BY id ASC";
$stmt = $con->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();
 
// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Customer</a>";
 
//check if more than 0 record found
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
     
        //creating our table heading
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Last Name</th>";
            echo "<th>First Name</th>";
            echo "<th>Email</th>";
            echo "<th>Phone</th>";
            echo "<th>Action</th>";
        echo "</tr>";
         
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['firstname'] to
            // just $firstname only
            extract($row);
             
            // creating new table row per record
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$lastname}</td>";
                echo "<td>{$firstname}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$phone}</td>";
                echo "<td>";
                    // read one record 
                    echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>View</a>";
                     
                    // we will use this links on next part of this post
                    echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
                    
                    echo "<a href='measurements.php?id={$id}' class='btn btn-success m-r-1em'>Measurements</a>";
 
                    // we will use this links on next part of this post
                    echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
            echo "</tr>";
        }
     
    // end table
    echo "</table>";
}
 
// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
</div> <!-- end .container -->

<script type='text/javascript'>
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</body>
</html>