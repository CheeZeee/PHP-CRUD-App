<?php

include_once 'config/database.php';



try {
  $id = isset($_GET['id']) ? $_GET['id'] : die("Record not found");
  $query = "DELETE FROM products WHERE id=?";

  $stmt = $conn->prepare($query);

  $stmt->bindParam(1, $id);

  if ($stmt->execute()) {
    // redirect to "read records" page and tell the user that the record was deleted
    header('Location: read.php?action=deleted');
  }else {
    die('Unable to delete record!');
  }

} catch (PDOException $exception) {
  die("ERROR: ".$exception->getMessage());
}

?>
