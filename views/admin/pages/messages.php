<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row mt-12" style="min-height:60vh">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Inbox</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Message ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                        </tr>
                        </thead>
                        <?php
                        include "models/admin/inbox/functions.php";
                        $messages = getMessages();
                        ?>
                        <tbody>
                        <?php foreach($messages as $message) : ?>
                            <tr>
                                <td><?= $message -> messageId ?></td>
                                <td><?= $message -> username ?></td>
                                <td><?= $message -> email ?></td>
                                <td><?= $message -> subject ?></td>
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