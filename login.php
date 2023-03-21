<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | LOGIN</title>
    <?php include_once('./components/header.php'); ?>
</head>

<body class="bg-gray-200">
    <?php
    require_once ('./config/database.php');
    

    if ( isset( $_POST['btnLogin'] ) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $queryStr = "SELECT * FROM customer WHERE username = '$username' AND password = '$password'";
        $result = $db->query($queryStr);

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();

            $_SESSION['cusID'] = $result['CustomerID'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['firstname'] = $result['fname'];

            // Use SweetAlert2 instead of alert
            echo "<script>
                Swal.fire({
                    title: 'เข้าสู่ระบบสำเร็จ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = './index.php';
                });
            </script>";

            

        } else {
            // Use SweetAlert2 instead of alert
            echo "<script>
                Swal.fire({
                    title: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            </script>";
        }
        
    } 
?>

    <?php include_once('./components/menu.php') ?>


    <div class="h-screen">
    <div class="max-w-md mx-auto my-12 bg-white p-8 rounded-md shadow-sm w-6/12">
        <h2 class="text-2xl font-medium mb-4">เข้าสู่ระบบ</h2>
        <p class="text-gray-600 mb-6">กรุณากรอกข้อมูลในการเข้าสู่ระบบ</p>
        <form action="./login.php" method="post">
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
                <button name="btnLogin" type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Login
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