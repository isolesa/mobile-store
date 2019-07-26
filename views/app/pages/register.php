<div class=" w3l-login-form" xmlns="http://www.w3.org/1999/html">
    <h2>Register Here</h2>
    <form action="models/app/users/register.php" method="POST" onsubmit="return checkRegisterForm()">
        <div class=" w3l-form-group">
            <label>First name:</label>
            <div class="group7">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" placeholder="First name" name="firstName" id="firstName"/>
            </div>
        </div>
        <span class="error">Format: Capital letter and other letters (3 char. min./16 max.)</span>
        <div class=" w3l-form-group">
            <label>Last name:</label>
            <div class="group7">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" placeholder="Last name" name="lastName" id="lastName"/>
            </div>
        </div>
        <span class="error">Format: Capital letter and other letters (3 char. min./16 max.)</span>
        <div class=" w3l-form-group">
            <label>Username:</label>
            <div class="group7">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" value=""/>
                <input type="hidden" class="form-control isExists" value=""/>
            </div>
        </div>
        <span class="error">Format: Letters and numbers (5 char. min./25 max.)</span>
        <span class="not-unique"></br>Username already taken. Try something else.</span>
        <div class=" w3l-form-group">
            <label>E-mail:</label>
            <div class="group7">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" placeholder="E-mail" name="email" id="email"/>
                <input type="hidden" class="form-control isExists" value=""/>
            </div>
        </div>
        <span class="error">Format: School mail (ict.edu.rs)</span>
        <span class="not-unique"></br>E-mail already exists. Maybe you already created an account.</span>
        <div class=" w3l-form-group">
            <label>Password:</label>
            <div class="group7">
                <i class="fas fa-unlock"></i>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password"/>
            </div>
        </div>
        <span class="error">Format: uppercase, lowercase, number and special character (8 char. min.)</span>
        <div class=" w3l-form-group">
            <label>Repeat password:</label>
            <div class="group7">
                <i class="fas fa-unlock"></i>
                <input type="password" class="form-control" placeholder="Repeat password" name="repeatPassword" id="repeatPassword"/>
            </div>
        </div>
        <span class="error">Format: uppercase, lowercase, number and special character (8 char. min.)</span>
        <button type="submit" name="register">Register</button>
    </form>
</div>