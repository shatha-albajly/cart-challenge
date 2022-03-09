<?php

session_start();

require_once ("php/CreateDb.php");
require_once ("php/component.php");

$db = new CreateDb("Productdb", "Producttb");

if(isset($_POST['decrease'])) { 
    $id=(int)$_POST['id'];
    $_SESSION['cart'][$id]=$_SESSION['cart'][$id]-1;
}

if(isset($_POST['increase'])) { 
    $id=(int)$_POST['id'];
    $_SESSION['cart'][$id]=$_SESSION['cart'][$id]+1;
}

if (isset($_POST)){
    echo "</br>";
    print_r($_POST);
//   if ($_GET['action'] == 'remove'){
//       foreach ($_SESSION['cart'] as $key => $value){
//           if($value["product_id"] == $_GET['id']){
//               unset($_SESSION['cart'][$key]);
//               echo "<script>alert('Product has been Removed...!')</script>";
//               echo "<script>window.location = 'cart.php'</script>";
//           }
//       }
//   }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

    <?php
    require_once ('php/header.php');
?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>My Cart</h6>
                    <hr>

                    <?php
                    $c='';
                    $t=0;
                    $p=0;

                $total = 0;
                    if (isset($_SESSION['cart'])){
                        $product_id = $_SESSION['cart'];
                        print_r($product_id );
                        foreach ($product_id as $id => $value){
                            print_r($value );
                                echo "</br>";
                            $c=$value;
                           
                            $result = $db->getData();
                            while ($row = mysqli_fetch_assoc($result)){
                                if ($row['id'] == $id){

                                // print_r("total" );
                                // print_r((int)$row['product_price'] );
                                // print_r("total" );

                                // print_r($total );
                                // print_r("total" );


                                // print_r($value );
                                // echo "</br>";
                                // print_r($row );
                                // print_r($row['id'] );


                                    cartElement($row['id'],$row['product_image'], $row['product_name'],$row['product_price'], $row['id'],$value);
                                    $total = ($total + (int)$row['product_price'])*$value;
                                    $t=$t+$value;
                                    $p=$p+$total;
                             
                            }}}




    
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }

                ?>

                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            print_r( $_SESSION['cart']);
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart'])*$c;
                                echo "<h6>Price ($t items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $p; ?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>$<?php
                            echo $total;
                            ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>