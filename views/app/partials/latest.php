<h4 style="margin-top: 70px">Latest products</h4>
<div class="section group">
    <style>
        .phoneInfo{
            color:grey;
            font-size: 16px;
        }
    </style>
    <?php
    include "models/app/products/functions.php";
    $products = getLatest();
    foreach($products as $product) : ?>
        <div class="grid_1_of_4 images_1_of_4 products-info">
            <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>">
            <a href="<?= BASE_URL ?>?page=single&id=<?= $product -> productId ?>"><?= $product -> brandName." ".$product -> productName ?></a><br>
            <h6 class="phoneInfo" style="margin-top: 10px;">Price: <?= $product -> newPrice ?>&euro;</h6>
        </div>
    <?php endforeach; ?>
</div>