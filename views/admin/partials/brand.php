<tr>
    <td><?= $brand -> brandId ?></td>
    <td><?= $brand -> brandName ?></td>
    <td class="text-right">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <button class="dropdown-item update" data-id="<?= $brand -> brandId ?>" data-toggle="modal" data-target="#modal-update">Update</button>
                <button class="dropdown-item" id="deleteBrandBtn" href="#" data-id="<?= $brand -> brandId ?>">Delete</button>
            </div>
        </div>
    </td>
</tr>