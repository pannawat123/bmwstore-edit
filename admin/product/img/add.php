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
    require_once('./../../../config/database.php');

    if (!isset($_SESSION['empID'])) {
        echo "
        <script>
            Swal.fire({
                title: 'Not allow',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = './view.php';
            });
        </script>";
    }


    $id = $_GET['id'];
        
    $queryStr = "SELECT * FROM product WHERE ProductID = '$id'";
    $data_product = $db->query($queryStr);
    $data_product = $data_product->fetch_assoc();

    if (isset($_POST['btnAddImg'])) {

        $img_base64 = $_POST['img_base64'];

        $queryStr = "INSERT INTO productpictures (source,ProductID) 
                VALUE ('$img_base64', '$id')";
        $result = $db->query($queryStr);
        if($result){
            echo "
            <script>
                Swal.fire({
                    title: 'เพิ่มรูปภาพสำเร็จ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = './view.php?id=".$id."';
                });
            </script>";
        } else {
            echo "
            <script>
                Swal.fire({
                    title: 'เพิ่มรูปภาพไม่สำเร็จ',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = './view.php?id=".$id."';
                });
            </script>";
        }
    }  

?>
    <?php include_once('./../../../components/admin/menu.php'); ?>

    <div class="w-8/12 mx-auto my-12 bg-white p-8 rounded-md shadow-sm">
        <h3 class="text-center mb-4">เพิ่มรูปภาพสินค้า : <?php echo $data_product['name']; ?></h3>

        <form method="POST" action="./add.php?id=<?php echo $id; ?>" enctype="multipart/form-data" class="w-96 mx-auto">
            <div class="mb-3">
                <label class="block font-medium text-gray-700 mb-2">เลือกรูปภาพ</label>
                <input id="img_base64" name="img_base64" type="hidden" />
                <input id="fileImage" name="file" type="file"
                    class="block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary-500 focus:border-primary-500"
                    placeholder="fileImage" required>
            </div>

            <div class="flex justify-between">
                <button id="btnDelImg" onclick="setImagePreview()"
                    class="flex-shrink-0 w-2/4 justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    RESET
                </button>

                <button name="btnAddImg" type="submit"
                    class="flex-shrink-0 w-2/4 justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                    Add Image
                </button>

            </div>

            <a href="./view.php?id=<?php echo $id; ?>"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-2">
                Back
            </a>


        </form>

        <div class="flex justify-center">
            <img id="img_preview"
                src="https://eadn-wc04-3087778.nxedge.io/wp-content/uploads/edd/2012/10/file-uploads1.png" alt=""
                class="mt-2 w-6/12 h-6/12 object-cover object-center border border-gray-300 rounded-md">
        </div>

    </div>

</body>

</html>


<script type="text/javascript">
const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

const setImagePreview = (base64 = null) => {
    const img_preview = document.querySelector('#img_preview');
    const btn_delImg = document.querySelector('#btnDelImg');
    img_preview.src = base64;
    img_preview.style.height = base64 ? 500 : 0;
    base64 ? btn_delImg.classList.remove('d-none') : btn_delImg.classList.add('d-none');
}

document.querySelector('#fileImage').addEventListener('change', async (event) => {
    if (event.target.files[0]) {
        let base64 = await toBase64(event.target.files[0]);
        document.querySelector('#img_base64').value = base64;
        setImagePreview(base64);
    } else {
        setImagePreview();
    }
});
</script>