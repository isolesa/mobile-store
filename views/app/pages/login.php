<div class=" w3l-login-form">
    <h2>Login Here</h2>
    <form action="models/app/users/login.php" method="POST" onsubmit="return checkLoginForm()">
        <div class=" w3l-form-group">
            <label>E-mail:</label>
            <div class="group7">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" placeholder="E-mail" name="email" id="email" value="<?php if(isset($_GET["email"])) echo $_GET["email"]; ?>"/>
            </div>
        </div>
        <span class="error">Format: School mail (ict.edu.rs)</span>
        <div class=" w3l-form-group">
            <label>Password:</label>
            <div class="group7">
                <i class="fas fa-unlock"></i>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password"/>
            </div>
        </div>
        <span class="error">Format: uppercase, lowercase, number and special character (8 char. min.)</span>
        <?php
        if(isset($_GET["e"]) && $_GET["e"] === "wrong-credentials")
            echo "</br><span style=\"color:red;font-size:16px;padding:0 auto; width:100%;\" class=\"wc\">Sorry. Email or password isn't correct. Try again.</span>";
        ?>
        <button type="submit" name="login">Login</button>
    </form>
    <p class=" w3l-register-p">Don't have an account?<a href="<?= BASE_URL ?>/?page=register" class="register"> Register</a></p>
</div>