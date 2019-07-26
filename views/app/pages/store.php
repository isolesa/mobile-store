<div class="clear"> </div>
<div class="wrap" style="margin-top: 50px">
    <div class="content">
        <div class="content-grids">
            <div align="left" style="min-height:800px;">
                <div id="wrap" align="center">
                    <form style="margin-bottom:60px">
                        <div class="form-group w-75 p-3">
                            <select class="form-control" id="sortProducts">
                                <?php
                                $options = [["value" => 1,"sortType"=> "Sort by name - ascending"],["value" => 2,"sortType" => "Sort by name - descending"],["value" => 3,"sortType" => "Sort by price - descending"],["value" => 4,"sortType" => "Sort by price - ascending"]];
                                foreach($options as $option) : ?>
                                    <option value="<?= $option["value"] ?>"><?= $option["sortType"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                    <br clear="all" />
                    <ul class="myProducts">
                        <?php
                        $products = getProducts();
                        if($products){
                            $numberOfProducts = count($products);
                            $productsPerPage = 8;
                            if($numberOfProducts < $productsPerPage){
                                $numberOfPages = 1;
                                for($i = 0; $i < $numberOfProducts; $i++)
                                    include "views/app/partials/phone.php";
                            }
                            else{
                                $numberOfPages = ceil($numberOfProducts/$productsPerPage);
                                for($i = 0; $i < $productsPerPage; $i++)
                                    include "views/app/partials/phone.php";
                            }
                        } ?>
                        <br clear="all" />
                    </ul>
                    <br clear="all" />
                </div>
            </div>
        </div>
    </div>
    <?php include "views/app/partials/brands.php"; ?>
</div>
<div class="clear"> </div>
<ul class="pagination justify-content-center pagination-sm">
    <?php for($i = 0; $i < $numberOfPages; $i++) : ?>
        <?php if($i === 0) : ?>
            <li class="page-item disabled">
                <button class="page-link" href="#" tabindex="-1" style="width:auto;" value="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></button>
            </li>
        <?php else : ?>
            <li class="page-item"><button class="page-link" style="width:auto;" value="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></button></li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>