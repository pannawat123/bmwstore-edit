<div class="flex h-screen bg-gray-200">
    <div class="flex flex-col w-64 bg-gray-800">
        <div class="h-16 flex justify-center items-center text-white text-2xl font-semibold">
            <span>BMW - STORE</span>
        </div>
        <div class="relative flex-1 flex flex-col overflow-y-auto w-11/12 mx-auto">
            <a href="index.php" class="px-4 py-2 mt-4 text-white rounded-md bg-gray-700 hover:bg-gray-600">Products</a>
            <a href="history.php" class="px-4 py-2 mt-4 text-white rounded-md bg-gray-700 hover:bg-gray-600">Order History</a>


            <div class="absolute bottom-0 w-full">
                <div class="flex justify-center">
                    <?php if (isset($_SESSION['cusID'])): ?>
                    <div class="mt-4 flex items-center justify-center">
                        <div class="flex items-center">
                            <span
                                class="text-sm font-medium text-white mr-2"><?php echo "ชื่อผู้ใช้ : ".$_SESSION['username'] ?></span>
                            <a href="logout.php"
                                class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-500 hover:bg-gray-700">Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="mt-4 flex items-center justify-center">
                        <a href="login.php"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-500 hover:bg-gray-700">Log
                            in</a>
                        <a href="register.php"
                            class="ml-2 px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-500 hover:bg-gray-700">Register</a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col justify-center py-4 mt-3 w-full text-white text-center text-sm">
                        <div class="mx-auto">
                            &copy; BMW THAILAND 2022
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        <!-- Your main content here -->