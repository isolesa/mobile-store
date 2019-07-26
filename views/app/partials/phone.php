<li data-id="<?= $products[$i] -> productId ?>" class="itemsLi">
    <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $products[$i] -> source ?>" class="items" alt="<?= $products[$i] -> productName ?>"/>
    <br clear="all" />
    <div><a href="<?= BASE_URL ?>/?page=single&id=<?= $products[$i] -> productId ?>"><?= $products[$i] -> brandName." ".$products[$i] -> productName ?></a></div>
    <div><?= $products[$i] -> price ?>&euro;</div>
</li>