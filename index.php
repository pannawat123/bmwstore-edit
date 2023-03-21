<?php 
require_once ('./config/database.php');

$queryStr = "SELECT * FROM product";
$data_products = $db->query($queryStr);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | HOME</title>
    <?php include_once ('./components/header.php'); ?>
</head>

<body class="bg-gray-200">
    <?php include_once ('./components/menu.php') ?>

    <!-- <img src="https://www.bmw.co.th/content/dam/bmw/marketTH/bmw_co_th/happy_chinese_new_joy_2023/Motor-Show_Web-Hero-Banner_1680x756.jpg/jcr:content/renditions/cq5dam.resized.img.1680.large.time1678874503159.jpg"
        class="w-full rounded-lg" alt="Responsive image"> -->

    <div class="container mx-auto my-12">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-white p-4">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-bold">รายการสินค้า</h3>
                </div>
                <div class="p-5">
                    <div
                        class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-6">
                        <?php 
                        while($row = $data_products->fetch_assoc()): 
                            $rowID = $row['ProductID'];
                            $queryStr = "SELECT * FROM productpictures WHERE ProductID = '$rowID' LIMIT 1";
                            $img_product = $db->query($queryStr);
                            $img_product = $img_product->fetch_assoc();
                    ?>
                        <div class="bg-gray-300 rounded-lg shadow-xl overflow-hidden">
                            <div class="relative w-full h-48">
                                <img class="absolute inset-0 object-cover w-full h-full"
                                    src="<?php echo ($img_product ? $img_product['source'] : './assets/img/no_img.jpg'); ?>"
                                    alt="Product image">
                            </div>

                            <div class="px-6 py-4">
                                <h4 class="font-bold text-sm mb-2"><?php echo $row['name']; ?></h4>
                                <p class="text-gray-700 font-bold text-xl mb-2">
                                    ฿<?php echo number_format($row['price']); ?>
                                </p>
                                <div class="px-6 pt-4 pb-2">
                                </div>
                                <a href="./product.php?id=<?php echo $row['ProductID']; ?>"
                                    class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm uppercase hover:bg-gray-700 focus:bg-gray-700">สั่งซื้อสินค้า</a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once ('./components/footer.php'); ?>

</body>

</html>