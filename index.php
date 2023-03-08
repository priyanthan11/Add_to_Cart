<?php
//Start session
session_start();

require_once('php/CreateDb.php');
require_once('./php/component.php');

// Create instance of CreateDb class
$database = new CreateDB("ProductDb", "Producttb");
if (isset($_POST['add'])) {
  //print_r($_POST['product_id']);
  if (isset($_SESSION['cart'])) {
    $item_array_id = array_column($_SESSION['cart'], "product_id");
    //print_r($item_array_id);

    if (in_array($_POST['product_id'], $item_array_id)) {
      echo "<script>alert('Product is already added in the cart.')</script>";
      echo "<script>window.location = 'index.php</script>";
    } else {
      $count = count($_SESSION['cart']);
      $item_arry = array('product_id' => $_POST['product_id']);
      $_SESSION['cart'][$count] = $item_arry;
      //print_r($_SESSION['cart']);
    }
  } else {
    $item_arry = array('product_id' => $_POST['product_id']);

    //Crate new session variable
    $_SESSION['cart'][0] = $item_arry;
    //print_r($_SESSION['cart']);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <!--- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" crossorigin="anonymous">
  <!-- Bootstrap -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="style.css">

</head>


<body>

  <?php
  require_once("php/header.php");
  ?>

  <div class="container">
    <div class="row text-center py-5">
      <?php
      $result = $database->getData();
      while ($row = mysqli_fetch_assoc($result)) {
        component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
      }

      ?>
    </div>

  </div>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>