<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/admin/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<!--<script src="assets/admin/vendor/chart.js/dist/Chart.min.js"></script>-->
<!--<script src="assets/admin/vendor/chart.js/dist/Chart.extension.js"></script>-->
<!-- Argon JS -->
<script src="assets/admin/scripts/js/argon.js?v=1.0.0"></script>
<!-- Moj js -->
<?php switch(checkPage("admin")){

    case "Dashboard" :
        echo "<script src=\"assets/admin/scripts/js/dashboard.js\"></script>";
        break;

    case "Users" :
        echo "<script src=\"assets/admin/scripts/js/users.js\"></script>";
        break;

    case "Products" :
        echo "<script src=\"assets/admin/scripts/js/products.js\"></script>";
        break;

    case "Brands" :
        echo "<script src=\"assets/admin/scripts/js/brands.js\"></script>";
        break;

    case "Navigation" :
        echo "<script src=\"assets/admin/scripts/js/navigation.js\"></script>";
        break;
} ?>
</body>
</html>