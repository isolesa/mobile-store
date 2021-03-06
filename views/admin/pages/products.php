<!-- Page content -->
<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Products</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Price (&euro;)</th>
                            <th scope="col">Published</th>
                        </tr>
                        </thead>
                        <tbody id="productTbody">
                        <?php
                        include "models/admin/products/functions.php";
                        $products = getAllProducts();
                        foreach($products as $product) :
                            include "views/admin/partials/product.php";
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <style>
                        .col-lg-6 input:nth-child(0){
                            margin-top: 30px;
                        }
                        .text-center{
                            width:100%;
                        }
                        label{
                            margin-top: 10px;
                        }
                        .profileImg{
                            max-width: 150px;
                            max-height: 150px;
                            background-size:contain;
                            -webkit-background-size: contain;
                        }
                    </style>
                    <div id="updateModal">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "views/admin/partials/modal-insert.php";
    include "views/admin/fixed/footer.php"; ?>
</div>
</div>