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

            case "register" :
                echo "<a href=\"".BASE_URL."/?page=register\">Back to register page</a>";
                break;

            case "login" :
                echo "<a href=\"".BASE_URL."/?page=login\">Back to login page</a>";
                break;
        }
    } ?>
</div>