<button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-insert">Insert</button>
<div class="modal fade" id="modal-insert" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <?php
                $page = checkPage("admin");

                switch($page){

                    case "Users" :
                        include "views/admin/partials/modal-insert-user.php";
                        break;

                    case "Products" :
                        include "views/admin/partials/modal-insert-product.php";
                        break;

                    case "Brands" :
                        include "views/admin/partials/modal-insert-brand.php";
                        break;

                    case "Navigation" :
                        include "views/admin/partials/modal-insert-navigation.php";
                        break;
                }
                ?>
            </div>
        </div>
    </div>
</div>