<?php include "models/app/products/functions.php"; ?>
<div class="clear"> </div>
<div class="wrap">
    <?php if(isset($_GET["id"])) : $productId = $_GET["id"] ?>
        <div class="content" style="min-height:60vh">
            <?php
            $product = getProduct($productId);
            if(!$product) : ?>
                <h4 style="margin:100px auto; width:100%; text-align:center; color:red;">Sorry. This product doesn't exist.</h4>
            <?php else : ?>
                <div class="content-grids">
                    <div class="details-page">
                        <div class="back-links">
                            <ul>
                                <li><a href="<?= BASE_URL ?>">Home</a><img src="<?= BASE_URL ?>/assets/app/images/arrow.png" alt=""></li>
                                <li><a href="<?= BASE_URL ?>?page=store">Store</a><img src="<?= BASE_URL ?>/assets/app/images/arrow.png" alt=""></li>
                                <li><a href="#"><?= $product -> brandName." ".$product -> productName ?></a>
                            </ul>
                        </div>
                    </div>
                    <style>
                        .detalis-image, .detalis-image-details{
                            margin: 50px auto;
                        }
                        .brand-history{
                            padding: 20px 50px;
                        }
                    </style>
                    <div class="detalis-image">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>">
                                    <div class="thumb-image"> <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>" data-imagezoom="true" class="img-responsive" alt="" /> </div>
                                </li>
                                <li data-thumb="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>">
                                    <div class="thumb-image"> <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>" data-imagezoom="true" class="img-responsive" alt="" /> </div>
                                </li>
                                <li data-thumb="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>">
                                    <div class="thumb-image"> <img src="<?= BASE_URL ?>/assets/app/images/phones/profile/<?= $product -> source ?>" data-imagezoom="true" class="img-responsive" alt="" /> </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="detalis-image-details">
                        <div class="details-categories">
                            <ul>
                                <li><h3>Category:</h3></li>
                                <li class="active1"><span><?= $product -> brandName ?> Mobiles</span></li>
                            </ul>
                        </div><br><br>
                        <div class="clear"> </div>
                        <div class="brand-value">
                            <h3><?= $product -> brandName." ".$product -> productName ?></h3>
                            <div class="left-value-details">
                                <ul>
                                    <li>Price:</li>
                                    <?php if($product -> price !== $product -> newPrice) : ?>
                                        <li><span><?= $product -> price ?>&euro;</span></li>
                                        <li><h5><?= $product -> newPrice ?>&euro;</h5></li>
                                    <?php else : ?>
                                        <li><h5><?= $product -> price ?>&euro;</h5></li>
                                    <?php endif; ?>
                                    <br />
                                    <li class="prating">
                                        <?php if(isset($_SESSION["user"])) $userId = $_SESSION["user"] -> userId;
                                        $counter = 0; $userRating = null; $sum = 0;
                                        $openRatingFile = fopen(RATING,"r");
                                        $ratings = file(RATING);
                                        foreach($ratings as $rating){
                                            $parts = explode(";",$rating);
                                            if($parts[1] === $productId){
                                                $counter++;
                                                $sum = $sum + (int)$parts[2];
                                            }
                                        }
                                        $numberOfVotes = $counter;
                                        if($numberOfVotes !== 0) $averageRating = round($sum / $numberOfVotes,2);
                                        if($numberOfVotes === 0) : ?>
                                            Rating: Not rated!
                                        <?php elseif($numberOfVotes === 1) : ?>
                                            Rating: <?= $averageRating ?> &nbsp;&nbsp;&nbsp;(One user rated this product)
                                        <?php else : ?>
                                            Rating: <?= $averageRating ?> &nbsp;&nbsp;&nbsp;(<?= $numberOfVotes ?> users rated this product)
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                            <style>
                                .rating{
                                    margin-left:7px !important;
                                }
                            </style>
                            <?php if(isset($_SESSION["user"])) : ?>
                                <?php
                                foreach($ratings as $rating){
                                    $parts = explode(";",$rating);
                                    if($parts[0] === $userId && $parts[1] === $productId) $userRating = $parts[2];
                                }
                                ?>
                                <div class="right-value-details">
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2 ratingGroup" role="group" aria-label="First group">
                                            <h6>Rate this product!</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php if($userRating !== null) :
                                                for($i = 1; $i < 6; $i++) :
                                                    if($i == $userRating) : ?>
                                                        <button type="button" class="btn btn-success btn-sm rating" data-id="<?= $i ?>"><?= $i ?></button>
                                                    <?php else : ?>
                                                        <button type="button" class="btn btn-outline-success btn-sm rating" data-id="<?= $i ?>"><?= $i ?></button>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            <?php else : ?>
                                                <?php for($i = 1; $i < 6; $i++) : ?>
                                                    <button type="button" class="btn btn-outline-success btn-sm rating" data-id="<?= $i ?>"><?= $i ?></button>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden-one" id="hidden-one" value="<?= $userId ?>">
                                <input type="hidden" name="hidden-two" id="hidden-two" value="<?= $productId ?>">
                            <?php endif; ?>
                            <div class="clear"> </div>
                        </div>
                        <div class="clear"> </div>
                        <?php if($product -> description != null) : ?>
                            <div class="brand-history" style="width:100%;">
                                <h3>Description :</h3>
                                <p><?= $product -> description ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="clear"> </div>
                    </div>
                    <div class="clear"> </div>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="content" style="min-height:60vh"><h4 style="margin:100px auto; text-align:center; width:100%; color:red;">Sorry. This product doesn't exist.</h4></div>
    <?php endif; ?>
</div>
<div class="clear"> </div>