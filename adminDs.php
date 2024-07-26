<?php
ob_start();
include './config.php';
$stmt = $pdo->query("SELECT COUNT(*) as product_count FROM products");
$product_count = $stmt->fetch(PDO::FETCH_ASSOC)['product_count'];
$stmt = $pdo->query("SELECT COUNT(*) as order_count FROM orders");
$order_count = $stmt->fetch(PDO::FETCH_ASSOC)['order_count'];
$stmt = $pdo->query("SELECT COUNT(*) as admin_count FROM users WHERE isAdmin = 1");
$admin_count = $stmt->fetch(PDO::FETCH_ASSOC)['admin_count'];
$stmt = $pdo->query("SELECT COUNT(*) as user_count FROM users WHERE isAdmin = 0");
$user_count = $stmt->fetch(PDO::FETCH_ASSOC)['user_count'];
$stmt = $pdo->query("SELECT * FROM contacts");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="p-2 grid lg:grid-cols-4 md:grid-cols-3 grid-col-1 gap-5">
    <div class="bg-gray-800 text-gray-200 h-48 rounded-lg flex justify-around items-center">
        <div class=" ">
            <i class="fa-solid fa-user-tie text-white text-8xl"></i>
        </div>
        <div class=" text-2xl font-semibold">
            <h1 class=" mb-3">Admins</h1>
            <h1><?php echo $admin_count ?></h1>
        </div>
    </div>
    <div class="bg-gray-800 text-gray-200 h-48 rounded-lg flex justify-around items-center">
        <div class=" ">
            <i class="fa-solid fa-user text-white text-8xl"></i>
        </div>
        <div class=" text-2xl font-semibold">
            <h1 class=" mb-3">Users</h1>
            <h1><?php echo $user_count ?></h1>
        </div>
    </div>
    <!-- product -->
    <div class="bg-gray-800 text-gray-200 h-48 rounded-lg flex justify-around items-center">
        <div class=" ">
        <i class="fa-solid fa-palette text-white text-8xl"></i>
        </div>
        <div class=" text-2xl font-semibold">
            <h1 class=" mb-3">Products</h1>
            <h1><?php echo $product_count ?></h1>
        </div>
    </div>
    <!-- order -->
    <div class="bg-gray-800 text-gray-200 h-48 rounded-lg flex justify-around items-center">
        <div class=" ">
            <i class="fa-solid fa-truck-fast text-white text-8xl"></i>
        </div>
        <div class=" text-2xl font-semibold">
            <h1 class=" mb-3">Orders</h1>
            <h1><?php echo $order_count ?></h1>
        </div>
    </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg  p-2">
    <h1 class=" py-2 text-gray-600 font-semibold text-2xl">Customer Message</h1>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Message
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-4"><?=$contact['name']?></td>
                <td class="px-6 py-4"><?=$contact['title']?></td>
                <td class="px-6 py-4"><?=$contact['message']?></td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
include './dashboard.php';
?>