<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Create New Record</title>
    <!-- Add Bootstrap CSS file here -->
    <link rel="stylesheet" href="libs/bootstrap-3.3.6/css/bootstrap.min.css">

    <!--Add HTML5 Shiv and Respond.js to support IE8- -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h1>Create New Product</h1>
      </div>
      <?php
        if ($_POST) {
          include 'config/database.php';

          try {
            //insert query
            $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";

            //prepare query for execution
            $stmt = $conn->prepare($query);

            //validate user input
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $price = htmlspecialchars(strip_tags($_POST['price']));

            //bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);

            // specify when the record was created in the database
            $created=date('Y-m-d H:i:s');

            // bind this parameter
            $stmt->bindParam(':created', $created);

            // execute the query
            if ($stmt->execute()) {
              echo "<div class='alert alert-success alert-dismissible'> <a href='#' data-dismiss='alert' class='close' aria-label='close'>&times;</a> Record was successfully created</div>";
            }else{
              echo "<div class='alert alert-danger alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Unable to create record</div>";
            }
          } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
          }

        }

      ?>
      <form action="create.php" method="post">
        <table class="table table-hover table-responsive table-bordered">
          <tr>
            <td>Name</td>
            <td><input type="text" name="name" class="form-control" required /></td>
          </tr>

          <tr>
            <td>Description</td>
            <td><textarea name="description" class="form-control" required></textarea></td>
          </tr>

          <tr>
            <td>Price</td>
            <td><input type="text" name="price" class="form-control" required/></td>
          </tr>

          <tr>
            <td></td>
            <td>
              <input type="submit" value="Save" class="btn btn-primary" />
              <a href="read.php" class="btn btn-info">Read all Products</a>
            </td>
          </tr>
        </table>
      </form>
    </div>
  <script src="libs/jquery-3.1.0.min.js"></script>
  <script src="libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>
