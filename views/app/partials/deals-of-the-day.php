<h4 style="margin-top: 70px">Deals of the day</h4>
<div class="section group">
    <?php
    $products = getDealsOfTheDay();
    foreach($products as $product) : ?>
        <div class="grid_1_of_4 images_1_of_4 products-info">
            <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>">
            <a href="<?= BASE_URL ?>?page=single&id=<?= $product -> productId ?>"><?= $product -> brandName." ".$product -> productName ?></a><br>
            <h6 class="phoneInfo" style="margin-top: 10px;">Price: <?= $product -> newPrice ?>&euro;</h6>
            <h6 class="phoneInfo">Sale: <?= $product -> sale ?>%</h6>
        </div>
    <?php endforeach; ?>
</div>