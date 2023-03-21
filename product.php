<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | PRODUCT</title>
    <?php include_once "./components/header.php"; ?>
</head>

<body class="bg-gray-200">

<?php   
    require_once "./config/database.php";

    $id = $_GET["id"] ?? null;
    if (!$id) {
        echo "
        <script>
            Swal.fire({
                title: 'ไม่พบข้อมูลสินค้า',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './login.php';
            });
        </script>";
    }

    $sql = "SELECT * FROM product WHERE ProductID = '$id'";
    $data_product = $db->query($sql);
    $data_product = $data_product->fetch_assoc();

    $sql = "SELECT * FROM productpictures WHERE ProductID = '$id'";
    $data_picture = $db->query($sql);
    $mainImg = $db->query($sql);
    $mainImg = $mainImg->fetch_assoc();

    if (isset( $_POST['btnPurchase'] )) {
        
        $productID = $_GET['id'];
        $customerID = $_SESSION['cusID'];
        $qty = $_POST['qty'];
        $price = floatval($_POST['price']) * intval($qty);

        if ($qty > $data_product["qty"] || $qty < 1) {
            echo "
            <script>
                Swal.fire({
                    title: 'จำนวนสินค้าไม่ถูกค้อง',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                })
            </script>";

        } else {

        $queryUpdateProduct = "UPDATE product SET qty = (qty - $qty) WHERE ProductID = '$productID'";
        $result_updateProduct = $db->query($queryUpdateProduct);

        $queryInsertDetailSell = "INSERT INTO detailsale (pricebaht, quantity, ProductID)
                    VALUE ('$price', '$qty', '$productID')";
        $result_recodeDetailSell = $db->query($queryInsertDetailSell);

        $queryGetNowDetailSell = "SELECT DetailID FROM detailsale ORDER BY DetailID DESC LIMIT 1";
        $DetailID = $db->query($queryGetNowDetailSell);
        $DetailID = $DetailID->fetch_assoc();
        $DetailID = $DetailID['DetailID'];
        
        $queryInsertSale = "INSERT INTO salesdata (CustomerID, DetailID)
                    VALUE ('$customerID', '$DetailID')";
        $result_recodeDataSale = $db->query($queryInsertSale);
        
        echo "
        <script>
            Swal.fire({
                title: 'สั่งซื้อสินค้าสำเร็จ',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './index.php';
            });
        </script>";

        }
    }
?>

    <?php 
    include_once "./components/menu.php"; 
?>
    <div class="container mx-auto my-12">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-white p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-3xl font-bold">รายละเอียดสินค้า</h3>
                </div>
                
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 border-r">

                        <div class="p-3">
                            <div class="text-center p-4">
                                <img id="main_product_image" src="<?php echo $mainImg
                                    ? $mainImg["source"]
                                    : "./assets/img/no_img.jpg"; ?>" class="w-full md:w-11/12">
                            </div>
                            <div class="thumbnail flex justify-center gap-2">
                                <?php while (
                                    $pic = $data_picture->fetch_assoc()
                                ):
                                    echo '<img onclick="changeImage(this)" src="' .
                                        $pic["source"] .
                                        '" class="w-14"> ';
                                endwhile; ?>
                            </div>
                        </div>

                    </div>

                    <div class="w-full md:w-1/2">

                        <div class="p-4">
                            <div class="mt-4 mb-3">
                                <h5 class="text-uppercase font-bold"><?php echo $data_product["name"]; ?></h5>
                                <div class="price flex items-center">
                                    <span
                                        class="act-price text-lg">฿<?php echo number_format($data_product["price"]); ?></span>
                                </div>
                            </div>
                            <p class="about">คงเหลือ : <?php echo number_format($data_product["qty"]); ?></p>

                            <?php if (isset($_SESSION['cusID'])) { ?>
                            <form method="POST" action="./product.php?id=<?php echo $data_product['ProductID'] ?>">
                                <input name="price" value="<?php echo $data_product['price'] ?>" type="hidden" />
                                <input name="qty" value="1" type="number"
                                    class="form-control w-40 bg-gray-200 p-2" min="0" placeholder="จำนวน" />
                                <button id="confirmOrder" name="btnPurchase" type="submit" ></button>

                            </form>
                            <div class="cart mt-4 flex items-center">
                                <button onclick="alertConfirmOrder()"
                                    class="btn bg-red-500 text-white text-uppercase mr-2 px-4 py-2 rounded">สั่งซื้อสินค้า</button>
                            </div>
                            <?php } else { ?>

                            <p class="about m-4">** สินค้าทุกชินเก็บเงินปลายทาง **</p>
                            <a href="./login.php"
                                class="btn bg-red-500 text-white text-uppercase mr-2 px-4 py-2 rounded">!!
                                กรุณาเข้าสู่ระบบก่อนซื้อสินค้า
                            </a>

                            <?php }?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include_once ('./components/footer.php'); ?>
</body>

</html>

<script>
function alertConfirmOrder() {
    Swal.fire({
        title: 'คุณต้องการสั่งสินค้าใช่หรือไม่ ?',
        text: "คุณจะไม่สามารถยกเลิกได้",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('#confirmOrder').click();
        }
    })
}

function changeImage(element) {
    var main_prodcut_image = document.getElementById('main_product_image');
    main_prodcut_image.src = element.src;
}
</script>