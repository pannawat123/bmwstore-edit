<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | DASHBOARD</title>
    <?php include_once('./../components/header.php'); ?>
</head>

<body class="bg-gray-200">
<?php
    require_once('./../config/database.php');

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

    $queryStr = "SELECT * FROM detailsale;";
    $sale = $db->query($queryStr);
    $total_sale = 0;
    while ($row = $sale->fetch_assoc()) {
        $total_sale += $row['pricebaht'];
    }

    $queryStr = "SELECT COUNT(*) as count FROM product";
    $product = $db->query($queryStr);
    $product = $product->fetch_assoc();

    $queryStr = "SELECT COUNT(*) as count FROM customer";
    $customer = $db->query($queryStr);
    $customer = $customer->fetch_assoc();

    $queryStr = "SELECT COUNT(*) as count FROM employee";
    $employee = $db->query($queryStr);
    $employee = $employee->fetch_assoc();

    

?>
    <?php include_once('./../components/admin/menu.php'); ?>

    <div class="container mx-auto my-12">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-white p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-3xl font-bold">Manager Product</h3>
                </div>

                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/4 px-4 mb-8">
                        <div class="bg-red-500 text-white rounded-lg shadow-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-xl font-bold">Income</div>
                                <span class="fas fa-coins"></span>
                            </div>
                            <div class="text-3xl font-bold"><?php echo number_format($total_sale) ?></div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-4 mb-8">
                        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-xl font-bold">Product</div>
                                <span class="fab fa-product-hunt"></span>
                            </div>
                            <div class="text-3xl font-bold"><?php echo $product['count']; ?></div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-4 mb-8">
                        <div class="bg-green-500 text-white rounded-lg shadow-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-xl font-bold">Customer</div>
                                <span class="fas fa-users"></span>
                            </div>
                            <div class="text-3xl font-bold"><?php echo $customer['count']; ?></div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-4 mb-8">
                        <div class="bg-yellow-500 text-white rounded-lg shadow-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-xl font-bold">Employee</div>
                                <span class="fas fa-user-gear"></span>
                            </div>
                            <div class="text-3xl font-bold"><?php echo $employee['count']; ?></div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>

</body>

</html>