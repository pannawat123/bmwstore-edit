<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | HISTORY </title>

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
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

    $queryStr = "SELECT * FROM salesdata";
    $data_sale = $db->query($queryStr);

?>

    <?php include_once('./../../components/admin/menu.php'); ?>


    <div class="container mx-auto my-12">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-white p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-3xl font-bold">ประวัติการสั่งซื้อสินค้าจากลูกค้า</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-600 font-semibold">#</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">สินค้า</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ผู้ซื้อ</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ที่อยู่</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">จำนวน</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ราคาต่อชิ้น</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ราคารวม</th>
                                <th class="px-4 py-2 text-gray-600 font-semibold">ยกเลิก</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <script>
                            function alertConfirmDelete(product_id, detail_sale_id, data_sale_id, qty) {
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
                                        window.location.href =
                                            `./delete.php?product_id=${product_id}&detail_sale_id=${detail_sale_id}&data_sale_id=${data_sale_id}&qty=${qty}`;
                                    }
                                })
                            }
                            </script>
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
                                
                                $customer_id = $sale['CustomerID'];
                                $customer = "SELECT * FROM customer WHERE CustomerID = $customer_id";
                                $customer = $db->query($customer);
                                $customer = $customer->fetch_assoc();

                                
                                
                                $total_price += floatval($detail['pricebaht']);
                        ?>
                            <tr>
                                <td class="border px-4 py-2"><?php echo $i++; ?></td>
                                <td class="border px-4 py-2">
                                    <a href="./../product/edit.php?id=<?php echo $product['ProductID']; ?>"
                                        class="text-black">
                                        <?php echo $product['name']; ?>
                                    </a>
                                </td>
                                <td class="border px-4 py-2"><a
                                        href="./../customer/edit.php?id=<?php echo $customer['CustomerID']; ?>"
                                        class="text-black">
                                        <?php echo $customer['fname'] . ' ' . $customer['lname'];  ?>
                                    </a></td>
                                <td class="border px-4 py-2"><?php echo $customer['address']; ?></td>
                                <td class="border px-4 py-2"><?php echo $detail['quantity']; ?></td>
                                <td class="border px-4 py-2"><?php echo number_format($product['price']); ?></td>
                                <td class="border px-4 py-2">
                                    <?php echo number_format($detail['pricebaht']); ?>
                                </td>
                                <td class="border px-4 py-2 flex justify-center"> <a
                                        onclick="alertConfirmDelete(<?php echo $product_id; ?>,<?php echo $detail_id; ?>,<?php echo $sale['SaleID']; ?>,<?php echo $detail['quantity']; ?>);">
                                        <i class="fa-solid fa-trash"></i>
                                    </a></td>

                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot class="border-y-2">
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <td colspan="5"></td>
                                <th scope="row" class="py-3 px-6 text-base text-right">ยอมรวม</th>
                                <td class="underline text-red-800 py-3 px-6 text-center text-lg">
                                    <?php echo number_format($total_price) ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>