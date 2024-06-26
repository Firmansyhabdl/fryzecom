<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

include 'components/wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<style>
   .category {
    padding: 20px;
    background: #f9f9f9;
}

.heading {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.category-box {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 80px;
    justify-items: center;
}

.box {
    text-decoration: none;
    color: #333;
    text-align: center;
}

.box img {
    width: 100px;
    height: 100px;
    object-fit: contain;
    margin-bottom: 10px;
}

.box h3 {
    font-size: 16px;
}

</style>

<body>
   

   <?php include 'components/user_header.php'; ?>

   <div class="home-bg">

      <section class="home">
         <div class="swiper home-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="foto/h1.png" alt="">
                  </div>
                  <div class="content">
                     <span>Diskon Hingga 50%</span>
                     <h3>Laptop Asus Terbaru</h3>
                     <a href="shop.php" class="btn">Beli Sekarang</a>
                  </div>
               </div>
               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="foto/h2.png" alt="">
                  </div>
                  <div class="content">
                     <span>Diskon Hingga 50%</span>
                     <h3>Laptop Acer Terbaru</h3>
                     <a href="shop.php" class="btn">Beli Sekarang</a>
                  </div>
               </div>
               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="foto/h3.png" alt="">
                  </div>
                  <div class="content">
                     <span>Diskon Hingga 50%</span>
                     <h3>Laptop HP Terbaru</h3>
                     <a href="shop.php" class="btn">Beli Sekarang</a>
                  </div>
               </div>
            </div>
            <div class="swiper-pagination"></div>
         </div>
      </section>

   </div>

   <section class="category">
    <h1 class="heading">Berbelanja Berdasarkan Kategori</h1>
    <div class="category-box">
        <a href="category.php?category=Asus" class="box">
            <img src="foto/Asus/Asus.png" alt="">
            <h3>Asus</h3>
        </a>
        <a href="category.php?category=Acer" class="box">
            <img src="foto/Acer/AcerAspire 3 A314-36M-37EEPure Silver.png" alt="">
            <h3>Acer</h3>
        </a>
        <a href="category.php?category=Lenovo" class="box">
            <img src="foto/Lenovo/Lenovo.jpg" alt="">
            <h3>Lenovo</h3>
        </a>
        <a href="category.php?category=HP" class="box">
            <img src="foto/HP/Hp.png" alt="">
            <h3>HP</h3>
        </a>
        <a href="category.php?category=Axioo" class="box">
            <img src="foto/Axioo/Axioo.png" alt="">
            <h3>Axioo</h3>
        </a>
        <a href="category.php?category=Infinix" class="box">
            <img src="foto/Infinix/Infinix.png" alt="">
            <h3>Infinix</h3>
        </a>
        <a href="category.php?category=Dell" class="box">
            <img src="foto/Dell/dell.png" alt="">
            <h3>Dell</h3>
        </a>
        <a href="category.php?category=Toshiba" class="box">
            <img src="foto/Toshiba/toshiba.png" alt="">
            <h3>Toshiba</h3>
        </a>
    </div>
</section>


   <section class="products">

      <h1 class="heading">Produk Terbaru</h1>

      <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>Rp</span><?= number_format($fetch_product['price'], 0, ',', '.'); ?><span>,-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="Masukkan ke keranjang" class="btn" name="add_to_cart">
         </form>
         <?php
            }
         } else {
            echo '<p class="empty">Belum ada produk yang ditambahkan!</p>';
         }
      ?>


      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>

   <script>
      var homeSwiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      var categorySwiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: { slidesPerView: 2 },
            650: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 5 },
         },
      });

      var productsSwiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: { slidesPerView: 2 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
         },
      });
   </script>


</body>

</html>