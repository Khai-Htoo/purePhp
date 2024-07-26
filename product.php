<?php
ob_start();
include './config.php';

$errors = [];
$successes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $name = $_POST['medicine_name'];
        $price = $_POST['price'];
        $adult = $_POST['adult'] == 'on' ? 1 : 0;
        $kid = $_POST['kid'] == 'on' ? 1 : 0;
        $description = $_POST['medicine_description'];
        $imageFileName = $_FILES['image']['name'];
        $imageTempName = $_FILES['image']['tmp_name'];
        $image = './uploads/' . $imageFileName;
        move_uploaded_file($imageTempName, $image);

        $stmt = $pdo->prepare("INSERT INTO products (medicine_name, price, medicine_description, image ,adult , kid) VALUES (?, ?, ?, ?,?,?)");
        try {
            $stmt->execute([$name, $price, $description, $imageFileName, $adult, $kid]);
            $successes[] = 'Product added successfully.';
        } catch (PDOException $e) {
            $errors[] = 'Failed to add product: ' . $e->getMessage();
        }
    }

    if (isset($_POST['delete'])) {
        $product_id = $_POST['product_id'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        try {
            $stmt->execute([$product_id]);
            $successes[] = 'Product deleted successfully.';
        } catch (PDOException $e) {
            $errors[] = 'Failed to delete product: ' . $e->getMessage();
        }
    }
}

// Fetch products from database
try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = 'Failed to fetch products: ' . $e->getMessage();
}

// update product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['medicine_name'];
        $price = $_POST['price'];
        $eImage = $_POST['eImage'];
        $adult = $_POST['adult'] == 'on' ? 1 : 0;
        $kid = $_POST['kid'] == 'on' ? 1 : 0;
        $description = $_POST['medicine_description'];
        $imageFileName = $_FILES['image']['name'];
        $imageTempName = $_FILES['image']['tmp_name'];
        $image = './uploads/' . $imageFileName;
        move_uploaded_file($imageTempName, $image);
        try {
            $stmt = $pdo->prepare("UPDATE products SET medicine_name = ?, price = ?, medicine_description = ? , adult = ? , kid = ? ,image = ? WHERE id = ?");
            $stmt->execute([$name, $price, $description, $adult, $kid, $imageFileName ? $imageFileName : $eImage, $product_id]);
        } catch (\Throwable $th) {
            echo $th;
            return;
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

?>

<div class="relative overflow-x-auto p-2">
    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block mb-1 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" type="button">
        Create
    </button>
    <?php
// Error and success message handling
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo '<div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">';
        echo '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
        echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
        echo '</svg>';
        echo '<span class="sr-only">Error</span>';
        echo '<div class="ms-3 text-sm font-medium">';
        echo $error;
        echo '</div>';
        echo '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">';
        echo '<span class="sr-only">Close</span>';
        echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
        echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
        echo '</svg>';
        echo '</button>';
        echo '</div>';
    }
}
if (!empty($successes)) {
    foreach ($successes as $success) {
        echo '<div class="relative">';
        echo '<div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">';
        echo '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
        echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
        echo '</svg>';
        echo '<span class="sr-only">Info</span>';
        echo '<div class="ms-3 text-sm font-medium">';
        echo $success;
        echo '</div>';
        echo '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">';
        echo '<span class="sr-only">Close</span>';
        echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
        echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
        echo '</svg>';
        echo '</button>';
        echo '</div>';
        echo '</div>';
    }
}
?>


    <!-- Modal for creating product -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create Medicine
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="" class="px-2 my-3" method="post" enctype="multipart/form-data">
                    <input type="text" name="medicine_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Medicine Name" required />

                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-3" placeholder="Enter Price" required />

                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-3" required />


                    <div class="flex space-x-5 items-center py-3">
                        <div class="flex items-center ">
                            <input id="default-checkbox" name="adult" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Adult</label>
                        </div>
                        <div class="flex items-center ">
                            <input id="default-checkbox" name="kid" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kid</label>
                        </div>
                    </div>


                    <textarea name="medicine_description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-3" placeholder="Enter medicine description..." required></textarea>

                    <div class="mb-4">
                        <button type="submit" name="submit" class="w-full py-2 bg-blue-600 rounded-md text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Product table -->
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Medicine name
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Medicine Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Adult
                </th>
                <th scope="col" class="px-6 py-3">
                    Kid
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $product['medicine_name']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <img class="w-24 h-16 rounded-lg" src="<?php echo './uploads/' . $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $product['medicine_description']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $product['price'] . 'MMK'; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if ($product['adult']) {
    echo '<i class="fa-solid fa-check text-green-500 text-xl"></i>';
} else {
    echo '<i class="fa-solid fa-xmark text-red-500 text-xl"></i>';
}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if ($product['kid']) {
    echo '<i class="fa-solid fa-check text-green-500 text-xl"></i>';
} else {
    echo '<i class="fa-solid fa-xmark text-red-500 text-xl"></i>';
}?>
                    </td>
                    <td class="px-6 py-4  ">
                        <div class="flex items-center space-x-3">
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this product?');">
                                    <box-icon name='trash' type='solid' color='red'></box-icon>
                                </button>
                            </form>
                            <button data-modal-target="static-modal-<?php echo $product['id']; ?>" data-modal-toggle="static-modal-<?php echo $product['id']; ?>" type="button">
                                <box-icon name='message-square-edit' color='blue'></box-icon>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            <!-- edit model -->
            <?php foreach ($products as $product): ?>
                <div id="static-modal-<?php echo $product['id']; ?>" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit Product
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal-<?php echo $product['id']; ?>">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="px-3">
                                <form action="" class="px-2 my-3" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="text" name="medicine_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter medicine Name" value="<?php echo htmlspecialchars($product['medicine_name']); ?>" required />

                                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-3" placeholder="Enter Price" value="<?php echo $product['price']; ?>" required />

                                    <input type="hidden" name="eImage" value="<?php echo $product['image']; ?>">
                                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-3" />
                                    <div class="flex space-x-5 items-center py-3">
                        <div class="flex items-center ">
                            <input id="default-checkbox" <?php if ($product['adult']) {echo 'checked';}?> name="adult" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Adult</label>
                        </div>
                        <div class="flex items-center ">
                            <input id="default-checkbox" <?php if ($product['kid']) {echo 'checked';}?> name="kid" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kid</label>
                        </div>
                    </div>
                                    <textarea name="medicine_description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-3" placeholder="Enter medicine description..." required><?php echo $product['medicine_description']; ?></textarea>

                                    <div class="mb-4">
                                        <button type="submit" name="update" class="w-full py-2 bg-blue-600 rounded-md text-white">Update</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach;?>

        </tbody>
    </table>


</div>

<?php
$content = ob_get_clean();
include './dashboard.php';
?>