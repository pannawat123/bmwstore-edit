<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | AddCustomer </title>
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
            window.location.href = './index.php';
        });
    </script>";
}


if (isset($_POST['btnAddCus'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $queryStr = "INSERT INTO customer (fname,lname,address,tel,username,password) 
              VALUE ('$fname','$lname','$address','$tel','$username','$password')";
    // echo $queryStr;
    $result = $db->query($queryStr);

    if($result){
        echo "
        <script>
            Swal.fire({
                title: 'เพิ่มสมาชิกสำเร็จ',
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
                title: 'เพิ่มสมาชิกไม่สำเร็จ',
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
        <h3 class="text-center mb-4">เพิ่มข้อมูลสมาชิก</h3>
        <form method="POST" action="./add.php" class="mx-auto max-w-md">
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">ชื่อจริง</label>
                <input name="fname" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="เพิ่มชื่อจริง" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">นามสกุล</label>
                <input name="lname" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="เพิ่มนามสกุล" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">ที่อยู่</label>
                <input name="address" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="เพิ่มที่อยู่" required>
            </div>


            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">เบอร์โทรศัพท์</label>
                <input name="tel" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="เพิ่มเบอร์โทร" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">ชื่อผู้ใช้</label>
                <input name="username" type="text"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="เพิ่มชื่อผู้ใช้งาน" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">รหัสผ่าน</label>
                <input name="password" type="password"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="กรอกรหัสผ่าน" required>
            </div>

            <button name="btnAddCus"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-3">
                Add
            </button>
            <a href="./index.php"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-2">
                Back
            </a>
        </form>
    </div>

</body>

</html>