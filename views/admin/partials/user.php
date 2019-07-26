<tr>
    <td><?= $user -> firstName ?></td>
    <td><?= $user -> lastName ?></td>
    <td><?= $user -> username ?></td>
    <td><?= $user -> email ?></td>
    <td><?= $user -> dateOfBirth ?></td>
    <td><?= $user -> dateOfRegistration ?></td>
    <td><?= $user -> roleName ?></td>
    <td><?= $user -> active ?></td>
    <td class="text-right">
        <?php if($user -> userId !== "1" && $_SESSION["admin"]) : ?>
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <button class="dropdown-item update" data-id="<?= $user -> userId ?>" data-toggle="modal" data-target="#modal-update">Update</button>
                    <button class="dropdown-item" href="#" id="deleteUserBtn"  data-id="<?= $user -> userId ?>">Delete</button>
                </div>
            </div>
        <?php endif; ?>
    </td>
</tr>