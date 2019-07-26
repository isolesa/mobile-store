<style>
    .message{
        margin:100px auto;
        width:50%;
        height: auto;
        min-height: 50vh;
        text-align: center;
        color: red;
        font-size: 28px;
    }
    .message a{
        text-align: right;
        text-decoration: none;
        color: blue;
        font-size: 20px;
    }
</style>
<div class="message">
    <h2>Server side problem. Most likely you tried to access this page on improper way! Shame on you!</h2>
    <?php if(isset($_GET["e"])){
        $error = $_GET["e"];

        switch($error){
            case "users" :
                echo "<a href=\"".BASE_URL."/?access=admin&page=users\">Back to users page</a>";
                break;

            case "products" :
                echo "<a href=\"".BASE_URL."/?access=admin&page=products\">Back to products page</a>";
                break;

            case "brands" :
                echo "<a href=\"".BASE_URL."/?access=admin&page=brands\">Back to brands page</a>";
                break;

            case "navigation" :
                echo "<a href=\"".BASE_URL."/?access=admin&page=navigation\">Back to navigation page</a>";
                break;
        }
    }
    ?>
</div>