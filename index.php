<?php
ob_start();
include './config.php';
session_start();
$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['all'])) {
        $stmt = $pdo->query("SELECT * FROM products");
    } elseif (isset($_POST['kid'])) {
        $stmt = $pdo->query("SELECT * FROM products WHERE kid = 1");
    } elseif (isset($_POST['adult'])) {
        $stmt = $pdo->query("SELECT * FROM products WHERE adult = 1");
    } else {
        $stmt = $pdo->query("SELECT * FROM products");
    }
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
$error;
// order
if (isset($_POST['order'])) {
    if (empty($name)) {
        header("Location: login.php");
        exit();
    } else {
        $product_name = $_POST['product_name'];
        $qty = $_POST['qty'];
        $address = $_POST['address'];
        $price = $_POST['price'];
        $total = $qty * $price;
        $image = $_POST['image'];
        try {
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_name, qty, address, total,price,image) VALUES (?, ?, ?, ?, ?,?,?)");
            $stmt->execute([$user_id, $product_name, $qty, $address, $total, $price, $image]);
        } catch (\Throwable $th) {
            echo $th;
            return;
        }
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: "Order placed successfully"
                    });
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 1000); // 3000 milliseconds = 3 seconds
                });
              </script>';

        exit();
    }
}
?>
   <!-- banner -->
   <section class="w-full lg:h-[800px] md:h-[600px] h-[350px]  mt-20">
        <img class="w-full lg:h-[800px] md:h-[600px] h-[350px]" src="https://images.picxy.com/cache/2020/6/28/4e54e01e4b32b8d10be0a869222f78bf.jpg" alt="">
    </section>

    <!-- our service -->
    <section class=" p-32">
        <h1 class=" text-center text-4xl text-black/70 mb-10 font-semibold">Our Available Service</h1>
        <p class=" text-center text-black/50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
            perspiciatis minima, distinctio obcaecati culpa delectus eos voluptas consequuntur natus omnis
            necessitatibus veritatis, corporis exercitationem expedita corrupti. Incidunt accusamus sint autem. Lorem
            ipsum dolor sit amet consectetur adipisicing elit. Qui harum voluptatibus quia velit ullam neque ea aliquid
            dolor eveniet corrupti odio distinctio reprehenderit deleniti, minima dolorem inventore facilis
            necessitatibus eligendi?</p>
    </section>

    <!-- our product -->
    <section class=" md:px-32 px-10 mb-24 ">
        <h1 class=" text-center text-4xl text-black/70 mb-20 font-semibold ">Our Medicines</h1>
        <div class="flex justify-center pb-10">
            <div class=" flex items-center">
                <form action="" method="post">
                <button type="submit" name="all" class=" px-6 p-2 bg-gray-500 text-white">All</button>
                </form>
               <form action="" method="post">
               <button name="kid" type="submit" class=" px-6 p-2 bg-gray-500 text-white">Kid</button>
               </form>
                <form action="" method="post">
                <button name="adult" type="submit" class=" px-6 p-2 bg-gray-500 text-white">Adult</button>
                </form>
            </div>
        </div>
        <div class="grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 ">
        <?php foreach ($products as $product): ?>
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
        <img class="w-full h-60" src="<?php echo './uploads/' . $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-500 mt-3"><?php echo $product['medicine_name']; ?></h5>
        </a>
        <p class="mb-3 font-normal text-gray-400"><?php echo $product['medicine_description']; ?></p>
        <div class="">
            <strong class=" text-gray-600">Kid <?php if ($product['kid']) {
    echo '<i class="fa-solid fa-check text-green-500 text-xl"></i>';
} else {
    echo '<i class="fa-solid fa-xmark text-red-500 text-xl"></i>';
}?></strong>
<br>
 <strong class=" text-gray-600">Adult <?php if ($product['adult']) {
    echo '<i class="fa-solid fa-check text-green-500 text-xl"></i>';
} else {
    echo '<i class="fa-solid fa-xmark text-red-500 text-xl"></i>';
}?></strong>
        </div>
        <div class=" flex justify-between items-center">

        <button onclick="showOrderModel(<?php echo $product['id'] ?>)" class="block flex items-center space-x-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">

  <p>Add To Order</p>
  <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
</button>

        <h1 class=" text-gray-600"><?php echo $product['price'] . ' MMK'; ?></h1>
        </div>
    </div>
    <!-- order modal -->
     <div id="order-modal-<?php echo $product['id']; ?>" class=" w-full h-screen  fixed top-0  left-[-1px] hidden">
        <div class="flex items-center w-full h-full justify-center">
            <div class="px-3 w-[500px] bg-gray-700 py-5 rounded-lg">
                <div class="flex justify-between">
                <h1 class="px-3 text-white py-3 border-b border-gray-500">Order (<?php echo $product['medicine_name']; ?>)</h1>
                <button onclick="closeOBtn(<?php echo $product['id']; ?>)" class="text-white">Close</button>
                </div>

                    <form action="" class="px-2 my-3" method="post" >
                        <input type="hidden" name="product_name" value="<?php echo $product['medicine_name']; ?>">
                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                        <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                        <input type="number" name="qty" id="qty" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-3" placeholder="Enter Quantity"  required />
                        <textarea name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-3" placeholder="Enter address..." required></textarea>
                        <div class="my-4">
                            <button type="submit" name="order" class="w-full py-2 bg-blue-600 rounded-md text-white">Order Now</button>
                        </div>
                        <div class="h-3"></div>
                    </form>
                </div>
     </div></div>

    <?php endforeach;?>
        </div>
    </section>
<?php
$content = ob_get_clean();
include './clientLayout.php';
?>
<script>
     function showOrderModel(id){
        const model = document.getElementById(`order-modal-${id}`)
       model.classList.remove("hidden");
    }
    function closeOBtn(id){
        const model = document.getElementById(`order-modal-${id}`)
        model.classList.add("hidden");
    }

</script>