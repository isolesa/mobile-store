<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row mt-12">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Page visits in the last 24 hours</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#" class="btn btn-sm btn-primary exportLink">Export as Excel file</a>
                            <form action="models/admin/dashboard/download-excel.php" method="POST">
                                <input type="submit" style="display:none;" id="download">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Page name</th>
                            <th scope="col">Visits</th>
                        </tr>
                        </thead>
                        <?php
                        $urls = getVisitedPages(LOG);
                        ?>
                        <tbody>
                        <?php foreach($urls as $key => $value) : ?>
                            <tr>
                                <th scope="row">
                                    <?= $value["url"] ?>
                                    <input type="hidden" name="urlHidden" class="urlHidden" value="<?= $value["url"] ?>">
                                </th>
                                <td>
                                    <?= $value["visits"] ?>
                                    <input type="hidden" name="viditsHidden" class="visitsHidden" value="<?= $value["visits"] ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include "views/admin/fixed/footer.php"; ?>
</div>
</div>