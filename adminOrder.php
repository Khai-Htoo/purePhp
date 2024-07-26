<?php
ob_start();
include './config.php';
$stmt = $pdo->query("SELECT * FROM orders");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accept'])) {
        $orderId = $_POST['order_id'];
        $newStatus = 'accept';
        $stmt = $pdo->prepare("UPDATE orders SET stautus = ? WHERE id = ?");
        $stmt->execute([$newStatus, $orderId]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['reject'])) {
        $orderId = $_POST['order_id'];
        $newStatus = 'reject';
        $stmt = $pdo->prepare("UPDATE orders SET stautus = ? WHERE id = ?");
        $stmt->execute([$newStatus, $orderId]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<div class=" p-2">
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
                    <th scope="col" class="px-6 py-3">
                        Action
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
                    <td class="px-6 py-4">
                        <button class=" bg-gray-400 px-2 py-1 rounded-md text-white"><?=$order['stautus']?></button>
                    </td>
                    <td class="px-6 py-4 ">
                        <div class="flex space-x-2">
                            <!-- Form for accepting order -->
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?=$order['id']?>">
                                <button name="accept" type="submit" class=" bg-green-500 px-2 py-1 rounded-md text-white">Accept</button>
                            </form>
                            <!-- Form for rejecting order -->
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?=$order['id']?>">
                                <button name="reject" type="submit" class="bg-red-500 px-2 py-1 rounded-md text-white">Reject</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
include './dashboard.php';
?>