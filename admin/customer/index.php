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
    require_once ('./../../config/database.php');
    
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

    $queryStr = "SELECT * FROM customer";
    $result = $db->query($queryStr);

?>
    <?php include_once('./../../components/admin/menu.php'); ?>

    <div class="container mx-auto my-12">

        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-white p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-3xl font-bold">Manager Customer</h3>
                    <a href="./add.php"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                        เพิ่มสมาชิก</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-600 font-semibold">#</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">First Name</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">Last name</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">Address</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">Tel</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">Username</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <script>
                            function alertConfirmDelete(id) {
                                Swal.fire({
                                    title: 'ยืนยันการลบ',
                                    text: `คุณจะลบข้อมูลนี้ใช้หรือไม่`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'ตกลง'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = `./delete.php?id=${id}`;
                                    }
                                })
                            }
                            </script>
                            <?php 
            $i = 1;
            while ($row = $result->fetch_assoc()):
            ?>
                            <tr>
                                <td class="border px-4 py-2"><?php echo $i++; ?></td>
                                <td class="border px-4 py-2"><?php echo $row['fname']; ?></td>
                                <td class="border px-4 py-2"><?php echo $row['lname']; ?></td>
                                <td class="border px-4 py-2"><?php echo $row['address']; ?></td>
                                <td class="border px-4 py-2"><?php echo $row['tel']; ?></td>
                                <td class="border px-4 py-2"><?php echo $row['username']; ?></td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="./edit.php?id=<?php echo $row['CustomerID']; ?>">
                                            <i class="fa-solid fa-pen-to-square text-yellow-500"></i>
                                        </a>
                                        <a onclick="alertConfirmDelete(<?php echo $row['CustomerID']; ?>);">
                                            <i class="fa-solid fa-trash text-red-500"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>