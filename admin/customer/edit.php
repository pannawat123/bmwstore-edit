<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | Customer </title>

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


$id = $_GET['id'];

$queryStr = "SELECT * FROM customer WHERE CustomerID = '$id'";
$result = $db->query($queryStr);
$customer = $result->fetch_assoc();


if (isset($_POST['btnEditCus'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $username = $_POST['username'];

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $queryStr = "UPDATE customer
        SET fname = '$fname', lname = '$lname', address = '$address' , tel = '$tel' , username = '$username' , password = '$password'
        WHERE CustomerID = '$id'
    ";

    } else {
        
        $queryStr = "UPDATE customer
        SET fname = '$fname', lname = '$lname', address = '$address' , tel = '$tel' , username = '$username'
        WHERE CustomerID = '$id'
    ";
    
    }

    $result = $db->query($queryStr);
    // echo ($queryStr);
    if($result){
        echo "
        <script>
            Swal.fire({
                title: 'แก้ไขข้อมูลลูกค้าสำเร็จ',
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
                title: 'เกิดข้อผิดพลาด',
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
        <h3 class="text-center mb-4">แก้ไขข้อมูลสมาชิก</h3>
        <form method="POST" action="./edit.php?id=<?php echo $id; ?>" class="mx-auto max-w-md">
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">ชื่อจริง</label>
                <input name="fname" type="text" value="<?php echo $customer['fname'] ?>"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="แก้ไขชื่อจริง" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">นามสกุล</label>
                <input name="lname" type="text" value="<?php echo $customer['lname'] ?>"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="แก้ไขนามสกุล" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">ที่อยู่</label>
                <input name="address" type="text" value="<?php echo $customer['address'] ?>"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="แก้ไขที่อยู่" required>
            </div>


            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">เบอร์โทรศัพท์</label>
                <input name="tel" type="text" value="<?php echo $customer['tel'] ?>"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="แก้ไขเบอร์โทร" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">ชื่อผู้ใช้</label>
                <input name="username" type="text" value="<?php echo $customer['username'] ?>"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="แก้ไขชื่อผู้ใช้งาน" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">รหัสผ่าน</label>
                <input name="password" type="password"
                    class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    placeholder="กรอกรหัสผ่าน">
            </div>

            <button name="btnEditCus"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-3">
                Edit
            </button>
            <a href="./index.php"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-2">
                Back
            </a>
        </form>
    </div>

</body>

</html>