<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | REGISTER</title>
    <?php include_once('./components/header.php'); ?>
</head>

<body class="bg-gray-200">
<?php
    require_once ('./config/database.php');


    if (isset($_POST['btnRegister'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];

        $queryStr = "INSERT INTO customer (fname,lname,address,tel,username,password) 
                  VALUES ('$firstname','$lastname','$address','$telephone','$username','$password')";
        $result = $db->query($queryStr);

        if($result){
            echo "<script>
            Swal.fire({
                title: 'สมัครสมาชิกสำเร็จ',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './index.php';
            });
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'สมัครสมาชิกไม่สำเร็จ',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        </script>";
        }
    }  
        

?>
    <?php include_once('./components/menu.php') ?>

    <div class="h-screen mb-10">
        <div class="max-w-md mx-auto my-12 bg-white p-8 rounded-md shadow-sm w-6/12">
            <h2 class="text-2xl font-medium mb-4">สมัครสมาชิก</h2>
            <p class="text-gray-600 mb-6">กรุณากรอกข้อมูลในการสมัครสมาชิก</p>
            <form action="./register.php" method="post">
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" name="username"
                        class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 <?php echo (!empty($username_err)) ? 'border-red-500' : ''; ?>"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password"
                        class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 <?php echo (!empty($password_err)) ? 'border-red-500' : ''; ?>"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Firstname</label>
                    <input type="text" name="firstname"
                        class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 <?php echo (!empty($password_err)) ? 'border-red-500' : ''; ?>"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Lastname</label>
                    <input type="text" name="lastname"
                        class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 <?php echo (!empty($password_err)) ? 'border-red-500' : ''; ?>"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" name="address"
                        class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 <?php echo (!empty($password_err)) ? 'border-red-500' : ''; ?>"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Telephone</label>
                    <input type="text" name="telephone"
                        class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 <?php echo (!empty($password_err)) ? 'border-red-500' : ''; ?>"
                        required>
                </div>
                <div class="mb-4">
                    <button name="btnRegister" type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>
                <p class="text-gray-600 text-sm">สำหรับเจ้าหน้าที่ <a href="admin/login.php"
                        class="text-indigo-500 font-medium">Admin</a></p>
            </form>
        </div>
    </div>
    <?php include_once ('./components/footer.php'); ?>

</body>

</html>