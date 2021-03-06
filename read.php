             <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Read Records</title>
    <!-- Add Bootstrap CSS file here -->
    <link rel="stylesheet" href="libs/bootstrap-3.3.6/css/bootstrap.min.css">

    <!--Add HTML5 Shiv and Respond.js to support IE8- -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <style>
      .m-r-1em{ margin-right: 1em;}
      .m-b-1em{ margin-bottom: 1em; }
      .m-l-1em { margin-left: 1em; }
    </style>

  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h1>Create Product</h1>
      </div>
      <?php
        include_once 'config/database.php';

        /* code base to implement the delete action */

        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if redirected from delete.php
        if ($action == 'deleted') {
          echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        if ($action=='edited') {
          echo "<div class='alert alert-success'>Record was successfully updated.</div>";
        }

        /* End of delete action code implementation */

        // select all data
        $query = "SELECT id, name, description, price FROM products ORDER BY id DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // to get the number of rows returned
        $num = $stmt->rowCount();

        // link to create record form
        echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create new Product</a>";

        //check if more than 0 record found
        if ($num>0) {
          echo "<table class='table table-hover table-responsive table-bordered'>";
          echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>Name</th>";
          echo "<th>Description</th>";
          echo "<th>Price</th>";
          echo "<th>Action to take</th>";
          echo "</tr>";

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$name}</td>";
            echo "<td>{$description}</td>";
            echo "<td>{$price}</td>";
            echo "<td>";
            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>More Details</a>";

            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

            echo "<a href='#' onclick='delete_user({$id});' class='btn btn-danger'>Delete</a>";

            echo "</td>";

            echo "</tr>";

          }
          echo "</table>";
        }
        else {
          echo "<div>No records found!</div>";
        }

       ?>
    </div>
  <script src="libs/jquery-3.1.0.min.js"></script>
  <script src="libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function delete_user (id) {
      var answer = confirm('Are you sure?');
      if (answer) {
        // if user clicks OK, id is passed to delete.php to execute the delete query
        window.location = 'delete.php?id=' + id;
      }
    }
  </script>
  </body>
</html>
