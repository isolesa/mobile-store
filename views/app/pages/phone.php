<li data-id="<?= $products[$i] -> productId ?>" class="itemsLi">
    <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $products[$i] -> source ?>" class="items" alt="<?= $products[$i] -> productName ?>"/>
    <br clear="all" />
    <div><?= $products[$i] -> brandName." ".$products[$i] -> productName ?></div>
    <div><?= $products[$i] -> price ?>&euro;</div>
</li>