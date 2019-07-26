<tr>
    <td><?= $product -> brandName ?></td>
    <td><?= $product -> productName ?></td>
    <td><?= $product -> price ?></td>
    <td><?= $product -> published ?></td>
    <td class="text-right">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <button class="dropdown-item update" data-id="<?= $product -> productId ?>" data-toggle="modal" data-target="#modal-update">Update</button>
                <button class="dropdown-item" id="deleteProductBtn" href="#" data-id="<?= $product -> productId ?>">Delete</button>
            </div>
        </div>
    </td>
</tr>