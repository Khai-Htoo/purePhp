<?php
ob_start();
include './config.php';
$success;
// Check if the form was submitted via POST
if (isset($_POST['submit'])) {
    // Extract and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $title = htmlspecialchars($_POST['title']);
    $message = htmlspecialchars($_POST['message']);
    $stmt = $pdo->prepare("INSERT INTO contacts (name, title, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $title, $message]);
    if ($stmt->rowCount() > 0) {
        $success = 'Your message has been sent successfully';
    } else {
        echo "<p>Failed to send message. Please try again.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
<div class=" my-10">
<?php if (!empty($success)): ?>
                        <<div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <span class="sr-only">Info</span>
  <div class="ms-3 text-sm font-medium">
    <?php echo $success ?>
  </div>
  <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
    </svg>
  </button>
</div>
                    <?php endif;?>
   <div class=" flex  justify-center mt-32">
  <div class="">
    <h1 class=" text-gray-700 text-xl font-semibold pb-3">Our Location</h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d244399.58332251274!2d96.0167628167557!3d16.83907672853073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon%2C%20Myanmar%20(Burma)!5e0!3m2!1sen!2smz!4v1721901027227!5m2!1sen!2smz" width="1024" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class=" w-full bg-gray-100 mt-10 p-5 flex justify-between">
          <ul class=" text-2xl font-semibold text-gray-600 space-y-5">
            <li>Address : No 2 Str Yangon Hledan</li>
            <li>Phone : 09100100100</li>
            <li>podminporject@a.com</li>
          </ul>
          <div class=" w-[500px]">
            <h1 class=" text-xl text-gray-500 mb-3">Sent Message</h1>
            <form action="" method="post">
            <input
                  type="text"
                  name="name"
                  id="name"
                  class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Enter Name"
                  required=""
                />
                <input
                  type="text"
                  name="title"
                  id="title"
                  class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Enter title"
                  required=""
                />
                <textarea name="message"  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Enter message"
                  required="" id=""></textarea>
                  <button type="submit" name="submit" class=" w-full py-2 rounded-md bg-blue-500 text-white my-3">Submit</button>
            </form>
        </div>
        </div>

  </div>
   </div>
</div>
<?php
$content = ob_get_clean();
include './clientLayout.php';
