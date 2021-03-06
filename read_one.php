         <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Record Details</title>
    <!-- Bootstrap CSS file -->
    <link rel="stylesheet" href="libs/bootstrap-3.3.6/css/bootstrap.min.css">

    <!-- HTML5 Shiv and Respond.js to support IE8- -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h1>Product Details</h1>
      </div>

      <?php
        // check if a particular id is set using the isset() method
        $id = isset($_GET['id'])? $_GET['id'] : die('ERROR: Record could not be found.');

        include 'config/database.php';

        try {
          $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(1, $id);
          $stmt->execute();

          //store retrieved row to a variable
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // output values into form
          $name = $row['name'];
          $description = $row['description'];
          $price = $row['price'];
        } catch (Exception $exception) {
          die('ERROR: '. $exception->getMessage());
        }

      ?>

      <!-- Table to hold the record output -->
      <table class="table table-responsive table-hover table-bordered">
        <tr>
          <td>Name</td>
          <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><?php echo htmlspecialchars($description, ENT_QUOTES); ?></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><?php echo htmlspecialchars($price, ENT_QUOTES); ?></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="read.php" class="btn btn-primary">Read all Products</a>
          </td>
        </tr>
      </table>
    </div>
  <script src="libs/jquery-3.1.0.min.js"></script>
  <script src="libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>
