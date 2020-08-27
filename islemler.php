<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'phplogin';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


if( mysqli_connect_errno()){
    exit('Fail: ' . mysqli_connect_errno());
}



//kayıt işlemleri
if(isset($_POST['kayit'])){
    $email = $_POST['email'];
    $name = $_POST['username'];
    $sifre = $_POST['password'];  
    $tarih = date("Y.m.d");
    date_default_timezone_set('Europe/Istanbul');
    $zaman = date("h:i:sa");
    

    $asd = $conn->prepare("INSERT INTO accounts (email, username, password, date, time)
    VALUES ('$email', '$name', '$sifre', '$tarih','$zaman')");
    $asd->execute();
    echo 'kaydınız başarıyla alınmıştır.';
}

//silme işlemi

if(isset($_GET['username'])){
    
    $gelen = $_GET['username'];
    $sql = "DELETE FROM accounts WHERE username = '$gelen'";
    $sil = $conn->prepare($sql);
    $islem = $sil->execute();
    if($islem){
        echo "silindi";
    }
    else{
        echo "hata";
    }   
}
?>

<html>
<body>
    <h3> Verileri görmek için tıklayınız <a href="veriler.php">Tıklayın</a></h3>
</body>

</html>