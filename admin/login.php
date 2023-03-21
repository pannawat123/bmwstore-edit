<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | LOGIN</title>
    <?php include_once('./../components/header.php'); ?>
</head>

<body class="bg-gray-100">
    <?php
    
    require_once ('./../config/database.php');
    

    if ( isset( $_POST['btnLogin'] ) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $queryStr = "SELECT * FROM employee WHERE username = '$username' AND password = '$password'";
        $result = $db->query($queryStr);

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            
            $_SESSION['empID'] = $result['EmployeeID'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['firstname'] = $result['fname'];
            
            echo "
            <script>
                Swal.fire({
                    title: 'เข้าสู่ระบบสำเร็จ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = './dashboard.php';
                });
            </script>";

        } else {
            echo "
            <script>
                Swal.fire({
                    title: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                })
            </script>";
        }
        
    } 

?>

    <div class="container mx-auto mt-16 flex justify-center">
        <div class="w-full max-w-xs">
            <form method="POST" action="./login.php" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h3 class="text-2xl font-medium mb-6 text-center">เข้าสู่ระบบสำหรับเจ้าหน้าที่</h3>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="username">
                        Username
                    </label>
                    <input name="username" type="text" id="username" class="form-input mt-1 block w-full"
                        placeholder="กรอกชื่อผู้ใช้งาน" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="password">
                        Password
                    </label>
                    <input name="password" type="password" id="password" class="form-input mt-1 block w-full"
                        placeholder="กรอกรหัสผ่าน" required>
                </div>
                <div class="flex items-center justify-between">
                    <button name="btnLogin" type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                        Login
                    </button>
                </div>
                <div class="flex justify-center mt-6">
                    <a href="./../index.php" class="text-blue-500 font-semibold hover:text-blue-800">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>