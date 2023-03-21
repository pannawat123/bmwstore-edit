<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | Product </title>
    
    <?php include_once('./../../components/header.php'); ?>
</head>

<body class="bg-gray-200">
<?php
    require_once('./../../config/database.php');

    if (!isset($_SESSION['empID'])) {
        echo "
        <script>
            Swal.fire({
                title: 'Not allow',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './login.php';
            });
        </script>";
    }


    if (isset($_POST['btnAdd'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        

        $queryStr = "INSERT INTO product (name,price,qty) 
                VALUE ('$name','$price','$qty')";
        $result = $db->query($queryStr);

        if($result){
            echo "
            <script>
                Swal.fire({
                    title: 'เพิ่มสินค้าสำเร็จ',
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
                    title: 'เพิ่มสินค้าไม่สำเร็จ',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = './index.php';
                });
            </script>";
        }

    }  
?>

    <?php include_once('./../../components/admin/menu.php'); ?>

    <div class="max-w-md mx-auto my-12 bg-white p-8 rounded-md shadow-sm">
        <h3 class="text-center mb-4">เพิ่มสินค้า</h3>
        <form method="POST" action="./add.php" class="mx-auto max-w-md">
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">NameProduct</label>
                <input name="name" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="กรอกชื่อสินค้า" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">Price</label>
                <input name="price" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="กรอกราคาสินค้า" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">Qty</label>
                <input name="qty" type="number"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="กรอกจำนวนสินค้า" required>
            </div>

            <button name="btnAdd"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-3">
                เพิ่มสินค้า
            </button>
            <a href="./index.php"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-2">
                ย้อนกลับ
            </a>
        </form>
    </div>

</body>

</html>