<?php
ob_start();
include './config.php';
session_start();
ob_start();
$user_id = $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT * FROM orders WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class=" p-5 mt-16">
    <h1 class="py-3 text-gray-500 text-2xl font-semibold">Your Orders List</h1>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-4"><?=$order['product_name']?></td>
                <td class="px-6 py-4"><img class=" w-20 h-14 rounded-md" src="<?='./uploads/' . $order['image']?>" alt=""></td>
                <td class="px-6 py-4"><?=$order['address']?></td>
                <td class="px-6 py-4"><?=$order['qty']?></td>
                <td class="px-6 py-4"><?=$order['price']?></td>
                <td class="px-6 py-4"><?=$order['total']?></td>
                <td class="px-6 py-4"><?=$order['stautus']?></td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
</div>
</div>

<?php
$content = ob_get_clean();
include './clientLayout.php';
?>
