<body>
<div class="wrap">
    <!----start-Header---->
    <div class="header">
        <div class="clear"> </div>
        <div class="header-top-nav">
            <ul>
                <?php if(isset($_SESSION["admin"])) : ?>
                    <li><a href="<?= BASE_URL ?>/?access=admin">Admin panel</a></li>
                <?php endif; ?>
                <?php if(isset($_SESSION["user"])) : ?>
                    <li><?= $_SESSION["user"] -> firstName ?> <?= $_SESSION["user"] -> lastName ?></li>
                    <li><a href="<?= BASE_URL ?>/models/app/users/logout.php">Logout</a></li>
                <?php endif; ?>
                <?php if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"]) && !isset($_SESSION["superuser"])) : ?>
                    <li><a href="<?= BASE_URL ?>/?page=register">Register</a></li>
                    <li><a href="<?= BASE_URL ?>/?page=login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="clear"> </div>
    </div>
</div>
<div class="clear"> </div>
<div class="top-header">
    <div class="wrap">
        <!----start-logo---->
        <div class="logo">
            <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>/assets/app/images/logo.png" title="logo" /></a>
        </div>
        <!----end-logo---->
        <!----start-top-nav---->
        <div class="top-nav">
            <ul>
                <?php
                $navItems = getNavItems();
                foreach($navItems as $navItem) : ?>
                    <?php if($navItem -> itemName === "Home") : ?>
                        <li><a href="<?= BASE_URL ?>"><?= $navItem -> itemName ?></a></li>
                    <?php else : ?>
                        <li><a href="<?= BASE_URL ?>/?page=<?= strtolower($navItem -> itemName) ?>"><?= $navItem -> itemName ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear"> </div>
    </div>
</div>
<!----End-top-nav---->
<!----End-Header---->