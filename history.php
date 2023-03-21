<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | HISTORY</title>
    <?php include_once ('./components/header.php'); ?>
</head>

<body class="bg-gray-200">
    <?php 
    require_once ('./config/database.php');

    if(!isset($_SESSION['cusID'])) {
        echo "
        <script>
            Swal.fire({
                title: 'คุณยังไม่ได้เข้าสู่ระบบ',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './login.php';
            });
        </script>";

    } else {

        $customerID = $_SESSION['cusID'];
        $queryStr = "SELECT * FROM salesdata WHERE CustomerID = '$customerID'";
        $data_sale = $db->query($queryStr);

        include_once ('./components/menu.php');
    ?>

    <div class="container mx-auto my-12">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-white p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-3xl font-bold">ประวัติการสั่งซื้อ</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-600 font-semibold">#</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ชื่อสินค้า</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">จำนวน</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ราคาต่อชิ้น</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <?php 
                            $i = 1;
                            $total_price = 0;
                            while ($sale = $data_sale->fetch_assoc()):
                                $detail_id = $sale['DetailID'];
                                $detail = "SELECT * FROM detailsale WHERE DetailID = $detail_id";
                                $detail = $db->query($detail);
                                $detail = $detail->fetch_assoc();
                                
                                $product_id = $detail['ProductID'];
                                $product = "SELECT * FROM product WHERE ProductID = $product_id";
                                $product = $db->query($product);
                                $product = $product->fetch_assoc();
                                $total_price += floatval($detail['pricebaht']);
                        ?>
                            <tr>
                                <td class="border px-4 py-2"><?php echo $i++; ?></td>
                                <td class="border px-4 py-2"><?php echo $product['name']; ?></td>
                                <td class="border px-4 py-2"><?php echo $detail['quantity']; ?></td>
                                <td class="border px-4 py-2"><?php echo number_format($product['price']); ?></td>
                                <td class="border px-4 py-2"><?php echo number_format($detail['pricebaht']); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot class="border-t-2">
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <td colspan="3"></td>
                                <th scope="row" class="py-3 px-6 text-base text-right">ยอมรวม</th>
                                <td class="underline text-red-800 py-3 px-6 text-center text-lg">
                                    <?php echo number_format($total_price) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <?php } ?>
</body>

</html>