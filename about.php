<?php
ob_start();
?>
<section class="w-full lg:h-[800px] md:h-[600px] h-[350px]  mt-20">
        <img class="w-full lg:h-[800px] md:h-[600px] h-[350px]" src="https://t3.ftcdn.net/jpg/05/06/32/62/360_F_506326245_2GtSGEjKLDtpHS0FSkEBs4gV34DmTtS5.jpg" alt="">
    </section>

    <!-- our company -->
    <section class=" p-32">
        <h1 class=" text-center text-4xl text-black/70 mb-10 font-semibold">Our Company</h1>
        <p class=" text-center text-black/50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
            perspiciatis minima, distinctio obcaecati culpa delectus eos voluptas consequuntur natus omnis
            necessitatibus veritatis, corporis exercitationem expedita corrupti. Incidunt accusamus sint autem. Lorem
            ipsum dolor sit amet consectetur adipisicing elit. Qui harum voluptatibus quia velit ullam neque ea aliquid
            dolor eveniet corrupti odio distinctio reprehenderit deleniti, minima dolorem inventore facilis
            necessitatibus eligendi?</p>
    </section>

    <section class=" p-32">
        <h1 class=" text-center text-4xl text-black/70 mb-10 font-semibold">Our Partnership</h1>
        <p class=" text-center text-black/50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
            perspiciatis minima, distinctio obcaecati culpa delectus eos voluptas consequuntur natus omnis
            necessitatibus veritatis, corporis exercitationem expedita corrupti. Incidunt accusamus sint autem. Lorem
            ipsum dolor sit amet consectetur adipisicing elit. Qui harum voluptatibus quia velit ullam neque ea aliquid
            dolor eveniet corrupti odio distinctio reprehenderit deleniti, minima dolorem inventore facilis
            necessitatibus eligendi?</p>
    </section>
<?php
$content = ob_get_clean();
include './clientLayout.php';
?>