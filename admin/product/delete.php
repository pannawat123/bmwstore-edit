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

    $id = $_GET['id'];

    $queryStr = "DELETE FROM product WHERE ProductID = '$id'";
    $result = $db->query($queryStr);

    if($result){
        echo "
        <script>
            Swal.fire({
                title: 'ลบสินค้าสำเร็จ',
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
                title: 'ลบสินค้าไม่สำเร็จ',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './index.php';
            });
        </script>";
    }


    $queryStr = "DELETE FROM productpictures WHERE ProductID = '$id'";
    $result = $db->query($queryStr);
    
?>

</body>

</html>