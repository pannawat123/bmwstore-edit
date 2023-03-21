<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - STORE | Product </title>
    <?php include_once('./../../../components/header.php'); ?>
</head>

<body class="bg-gray-200">
    <?php
    require_once ('./../../../config/database.php');
    
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


    $id = $_GET['id'];
    
    $queryStr = "SELECT * FROM product WHERE ProductID = '$id'";
    $data_product = $db->query($queryStr);
    $data_product = $data_product->fetch_assoc();

    $queryStr = "SELECT * FROM productpictures WHERE ProductID = '$id'";
    $data_picture = $db->query($queryStr);
    
?>
    <?php include_once('./../../../components/admin/menu.php'); ?>

    <div class="container mx-auto mt-5 bg-white">
        <div class="bg-white p-10">
            <div class="w-full">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-2xl font-medium text-gray-800">แก้ไขรูปภาพสินค้า</h4>
                    <a href="./add.php?id=<?php echo $id; ?>"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">เพิ่มรูปภาพสินค้า</a>
                </div>

                <div class="mt-5">
                    <h3 class="text-lg font-bold">ชื่อสินสินค้า : <span
                            class="text-blue-500"><?php echo $data_product['name'] ?></span></h3>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                <script>
                            function alertConfirmDelete(pd_id,pic_id) {
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
                                        window.location.href = `./delete.php?pd_id=${pd_id}&pic_id=${pic_id}`;
                                    }
                                })
                            }
                            </script>
                    <?php 
      $i = 1;
      if ($data_picture):
        while ($row = $data_picture->fetch_assoc()):
          $i++;
    ?>
                    <div class="relative w-full h-60 md:h-72">
                        <a onclick="alertConfirmDelete(<?php echo $row['ProductID']; ?>,<?php echo $row['PictureID'] ?>);"
                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded-md">
                            <i class="fas fa-trash"></i>
                        </a>
                        <img src="<?php echo $row['source']; ?>"
                            class="w-full h-full object-cover shadow-md rounded-md" />
                    </div>
                    <?php 
        endwhile; 
      endif;        
    ?>
                </div>

                <?php 
    if ($i == 1):
  ?>
                <p class="text-center mt-8 text-gray-500">- ยังไม่มีรูปภาพสินค้า -</p>
                <?php 
    endif; 
  ?>

            </div>
        </div>


</body>

</html>