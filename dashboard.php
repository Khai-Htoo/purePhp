<?php
session_start();
$name = $_SESSION['name'];
$id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user['isAdmin'] == 0) {
    header("Location: index.php");
    exit();
}
if (!$user) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="w-full h-screen flex">
        <!-- sidebar -->
        <div class="min-w-[300px] duration-500 sidebar bg-blue-950 max-h-screen md:relative absolute z-50 top-0 bottom-0 ml-[-300px] md:ml-0">
            <div class="p-3 mb-5 flex items-center justify-between">
                <div class="flex items-center">
                    <h1 class="text-yellow-500 text-xl font-semibold ml-3">
                        PLancy Asia
                    </h1>
                </div>
                <div onclick="closeMenu()" class="mt-[-10px] close cursor-pointer bg-white rounded-full size-5 flex justify-center items-center md:hidden block">
                    <p>x</p>
                </div>
            </div>

            <!--  -->
            <ul class="px-3">
            <li class="bg-slate-900 text-white py-3 px-1 rounded-lg px-3 mb-3">
                   <a href="./adminDs.php"> Dashboard</a>
                </li>
                <li class="bg-slate-900 text-white py-3 px-1 rounded-lg px-3 mb-3">
                   <a href="./adminOrder.php"> Order</a>
                </li>
                <li class="bg-slate-900 text-white py-3 px-1 rounded-lg px-3">
                   <a href="./product.php">Product</a>
                </li>
            </ul>
        </div>
        <div class="w-full max-h-screen overflow-y-scroll">
            <nav class="py-4 bg-slate-800 flex justify-between items-center">
                <div class="hidden md:block"></div>
                <p class="text-white md:hidden ml-3" onclick="showMenu()">Menu</p>
                <div class=" flex space-x-2 items-center mr-5">
                    <div class="text-white mr-4">
                        <?php
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
if (!empty($name)):
    echo $name;
endif;
?>
                    </div>
                    <div class=" bg-red-500 text-white rounded-md px-2 py-1 mr-5">
                        <form action="" method="post">
                            <button type="submit" name="logout" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent ">Logout</button>
                        </form>
                    </div>
                </div>

            </nav>
            <?php echo $content; ?>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
<script>
    const sidebar = document.querySelector(".sidebar");

    function showMenu() {
        sidebar.classList.remove("ml-[-300px]");
    }

    function closeMenu() {
        sidebar.classList.add("ml-[-300px]");
    }
</script>

</html>