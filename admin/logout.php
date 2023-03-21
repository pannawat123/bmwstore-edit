<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | LOGIN</title>
    <?php include_once('./../components/header.php'); ?>
</head>
<body>
    
<?php
    session_start();
    session_destroy();
    echo "
    <script>
        Swal.fire({
            title: 'ออกจากระบบสำเร็จ',
            icon: 'success',
            confirmButtonText: 'ตกลง'
        }).then(() => {
            window.location.href = './login.php';
        });
    </script>";
?>

</body>

</html>