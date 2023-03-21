<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | DELETE </title>
    <?php include_once('./../../components/header.php'); ?>
</head>

<body class="bg-gray-200">

<?php 

    require_once ('./../../config/database.php');

    $detail_sale_id = $_GET['detail_sale_id'];
    $data_sale_id = $_GET['data_sale_id'];
    $qty = $_GET['qty'];
    // $productID = $_GET['prouct_id'];

    $queryStr = "DELETE FROM salesdata WHERE SaleID = '$data_sale_id'";
    $result1 = $db->query($queryStr);
    $queryStr = "DELETE FROM detailsale WHERE DetailID = '$detail_sale_id'";
    $result2 = $db->query($queryStr);
    
    // $queryUpdateProduct = "UPDATE product SET qty = (qty + $qty) WHERE ProductID = '$productID'";
    // $result3 = $db->query($queryUpdateProduct);

    if($result1 && $result2){
        echo "
        <script>
            Swal.fire({
                title: 'ลบสำเร็จ',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './index.php';
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'ลบไม่สำเร็จ',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './index.php';
            });
        </script>";
    }

?>

</body>

</html>