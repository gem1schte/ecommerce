<!-- UI Source: startbootstrap-shop-homepage
 (https://github.com/StartBootstrap/startbootstrap-shop-homepage) 
 -->

<?php
require_once __DIR__ . '/core/config.php';

$sql = 'SELECT product_id, product_name, original_price,description,brand,price, star,product_images FROM products';
$result = $conn->query($sql);

if (!$result) {
  die("Prepare failed: " . $conn->error); // Debugging
}
?>

<?php include __DIR__ . ('/views/includes/header.php'); ?>

<title>Tempest Shopping</title>

<!-- Filters Sidebar -->
<?php
$brand = 'SELECT DISTINCT brand FROM products';
$brand_result = $conn->query($brand);
$brand = [];

if ($brand_result->num_rows > 0) {
  while ($row = $brand_result->fetch_assoc()) {
    $brand[] = $row['brand'];
  }
}
?>

<form action="index.php" method="POST">
  <div class="container py-5">
    <h4 class="mb-0"><i class="fa-solid fa-filter"></i><?= __('Filters') ?></h4>
    <div class="row g-4">
      <div class="col-lg-3">
        <div class="filter-sidebar p-4 shadow-sm">

          <h5 class="mb-4"><?= __('Brand') ?></h5>

          <label class="form-check-label" for="electronics">
            <?PHP

            foreach ($brand as $item) {
              echo "
                      <input class='form-check-input' type='checkbox' id='electronics'>";
              echo htmlspecialchars($item) . "<br>";
            }
            ?>
          </label>

          <button class="btn btn-outline-primary w-100"><?= __('Apply Filters') ?></button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- End Filters Sidebar -->

<!-- Section-->
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
          <div class="col mb-5">
            <div class="card h-100">

              <?php
              if ($row['original_price'] > $row['price']) {
                echo "<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>" . __('Sale') . "</div>";
              }
              ?>

              <?php
              if ($row['original_price'] > $row['price']) {
                $discount = round((($row['original_price'] - $row['price']) / $row['original_price']) * 100);
                echo "<div class='badge bg-success text-white position-absolute' style='top: 0.5rem; left: 0.5rem'>$discount%</div>";
              }
              ?>

              <!-- Product image-->
              <img class="card-img-top" src="<?php echo htmlspecialchars($row['product_images']); ?>" alt="..." />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                  <!-- Product reviews-->
                  <div class="d-flex justify-content-center small text-warning mb-2">
                    <div class=""><i class="fa-solid fa-star"></i><?php echo htmlspecialchars($row['star']); ?></div>
                  </div>

                  <!-- Product price-->
                  <span class="text-muted text-decoration-line-through">
                    <?php
                    if ($row['original_price'] > $row['price']) {
                      echo "$" . htmlspecialchars($row['original_price']);
                    };
                    ?>
                  </span>

                  $<?php echo htmlspecialchars($row['price']); ?>

                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer d-flex justify-content-between bg-light">
                <div class="text-center"><a class="btn btn-primary btn-sm" href="<?= WEBSITE_URL . "views/view_product.php?id=" ?><?php echo htmlspecialchars($row['product_id']); ?>"><?= __('View products') ?></a></div>
              </div>

            </div>
          </div>
      <?php }
      }
      ?>

    </div>
  </div>
</section>
<!-- End Section -->

<!-- Footer -->
<?php include __DIR__ . ('/views/includes/footer.php'); ?>

</body>

</html>