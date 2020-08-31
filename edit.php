<?php
    session_start();  //session başlatmak için
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'phplogin';   
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);  
      

    //güncelleme yapılan kısım
    if(isset($_GET['username'])){  //tabloya istenen verileri gönderiyoruz

        $gelenId = $_GET['username'];
       
        $kullanicilar = $conn->prepare("SELECT * FROM accounts WHERE username = '$gelenId' ");
        $kullanicilar->execute();
        foreach ($kullanicilar as $kullanici) {
            $id = $kullanici['id'];
            $email = $kullanici['email'];
            $username = $kullanici['username'];           
        } 
    }

    if(isset($_POST['edit'])){  //tabloya gelen verileri güncelleyip yeni değerleri ekliyoruz

        $email = $_POST['email'];
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $id = $_POST['id'];
        echo $id;
        echo $email;
        $kullanicilar = $conn->prepare("UPDATE accounts SET email='$email',  username='$username',  password='$pass' WHERE id = '$id'  ");
        $kullanicilar->execute();

        header('Location: veriler.php');
    }

?>

<!Doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div class="login">
        <h1>Güncelleme</h1>
        <form action="edit.php" method="post">
            <label for="E Mail">
                <i class="fas fa-user"></i>
            </label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
            <label for="Kullanici Adi">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?> "required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>" required>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="edit" value=Düzenle>
        </form>  
    </div>
</body>
</html>
