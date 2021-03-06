                  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update Record</title>
     <!-- Add Bootstrap CSS file here -->
    <link rel="stylesheet" href="libs/bootstrap-3.3.6/css/bootstrap.min.css">

    <!--Add HTML5 Shiv and Respond.js to support IE8- -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h1>Edit Product</h1>
      </div>
      <?php
        // check if a particular ID has been set before accessing it
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record not available for editing.');

        include_once 'config/database.php';

        try {
          $query = "SELECT name, description, price FROM products WHERE id = ? LIMIT 0,1";

          $stmt = $conn->prepare($query);

          $stmt->bindParam(1, $id);

          $stmt->execute();

          //store retrieved values in a variable
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          $name = $row['name'];
          $description = $row['description'];
          $price = $row['price'];

        } catch (Exception $exception) {
          die('ERROR: '. $exception->getMessage());
        }

        if ($_POST) {
          try {
            //updating the query
            $query = "UPDATE products SET name=:name, description=:description, price=:price WHERE id = :id";

            $stmt = $conn->prepare($query);

            // sanitize user input
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $price = htmlspecialchars(strip_tags($_POST['price']));

            //bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
              echo "<div class='alert alert-success alert-dismissible >
                      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Record was successfully updated
                    </div>";
              header('Location: read.php?action=edited');
            } else {
              echo "<div class='alert alert-danger alert-dismissible'>
                      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Unable to update record
                    </div>";
            }
          } catch (Exception $exception) {
            die("ERROR: ". $exception->getMessage());
          }

        }

      ?>

      <!-- create form that will contain already existing data -->
      <form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <table class="table table-hover table-bordered table-responsive">
          <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" class="form-control" required/></td>
          </tr>
          <tr>
            <td>Description</td>
            <td><textarea class="form-control"  required name="description"><?php echo htmlspecialchars($description, ENT_QUOTES); ?> </textarea></td>
          </tr>
          <tr>
            <td>Price</td>
            <td><input type="text" name="price" value="<?php echo htmlspecialchars($price, ENT_QUOTES); ?>" class="form-control" required/></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" value="Save changes" class="btn btn-info" />
              <a href="read.php" class="btn btn-danger">Read all products</a>
            </td>
          </tr>
        </table>
      </form>
    </div>
  <script src="libs/jquery-3.1.0.min.js"></script>
  </body>
  <script src="libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</html>
