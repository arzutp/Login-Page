<?php

?>
<Html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div class="login">
        <h1>Kayıt Ol</h1>
        <form action="islemler.php" method="post">
            <label for="E Mail">
                <i class="fas fa-user"></i>
            </label>
            <input type="email" name="email" placeholder="E Mail" id="email" required>
            <label for="Kullanici Adi">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Kullanici Adi" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Şifre" id="password" required>
            <input type="submit" name="kayit" value="Kayıt Ol">
        </form>  
    </div>
</body>
</Html>