<div class="content-sidebar" style="margin-top: 70px; text-align:center;">
    <button class="brandName" type="button" value="Brands" style="background:#94CB32 !important; margin:0 auto; border:none;padding:20px !important;font-family: Arial, Helvetica, sans-serif !importantfont-size:17px !important;color: darkslategrey !important;" disabled>Brands</button>
    <ul>
        <li style="text-align: center;"><button class="brandName" type="button" value="all" style="background:transparent !important;border:none;padding:20px !important;font-family: Arial, Helvetica, sans-serif !important;font-size:17px !important;color: darkslategrey !important;" data-id="all" data-active="0">All</button></li>
        <?php
        $brands = getBrands();
        foreach($brands as $brand) : ?>
            <li style="text-align: center;"><button class="brandName" type="button" value="<?= $brand -> brandName ?>" style="background:transparent !important;border:none;padding:20px !important;font-family: Arial, Helvetica, sans-serif !important;font-size:17px !important;color: darkslategrey !important;" data-id="<?= $brand -> brandId ?>" data-active="0"><?= $brand -> brandName ?></button></li>
        <?php endforeach; ?>
    </ul>
</div>