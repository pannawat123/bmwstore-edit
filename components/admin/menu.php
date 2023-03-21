<nav class="bg-gray-800">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="#" class="text-white">BMW - STORE | ADMIN</a>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <a onclick="redirect('admin/dashboard.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                        Dashboard</a>
                    <a onclick="redirect('admin/product/index.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                        Product</a>
                    <a onclick="redirect('admin/customer/index.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                        Customer</a>
                    <a onclick="redirect('admin/employee/index.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                        Employee</a>
                    <a onclick="redirect('admin/sell/index.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                        Order</a>
                </div>
            </div>
            <div class="hidden md:block">
                <?php if (isset($_SESSION['firstname'])): ?>
                <div class="ml-4 flex items-center md:ml-6">
                    <span
                        class="text-sm font-medium text-white mr-2"><?php echo "ชื่อผู้ใช้ : ".$_SESSION['firstname'] ?></span>
                    <a onclick="redirect('admin/logout.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-500 hover:bg-gray-700">Logout</a>
                </div>
                <?php else: ?>
                <div class="ml-4 flex items-center md:ml-6">
                    <a onclick="redirect('admin/login.php')"
                        class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-500 hover:bg-gray-700">Login
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>


<script>
const redirect = (url) => {

  let folderName = window.location.pathname
  folderName = folderName.split('/')[1]
  window.location.href = `${window.location.protocol}//${window.location.hostname}/${folderName}/${url}`;
};
</script>