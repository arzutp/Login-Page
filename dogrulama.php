<?php
// veritabanından verileri alıp doğrulama
//daha önceden giriş yapmış kişileri doğrulamak için
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'phplogin';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

//$con = mysqli_connect($DATABASE_HOST, $DATABASE_NAME, $DATABASE_PASS, $DATABASE_USER);


//veritabanına bağlanıyoruz ve kontrol ediyoruz

if(!isset($_POST['username'],$_POST['password'])){
    exit('Gecerli bir kullanici adi veya parola giriniz');
    
}

 $name = $_POST['username'];
 $sifre = $_POST['password'];
 $email = $_POST['email'];
 $tarih = date("Y.m.d h:i:sa");
 date_default_timezone_set('Europe/Istanbul');
 $zaman = date("h:i:sa");
 $ip = $_SERVER["REMOTE_ADDR"];

 $stmt = $conn->prepare("SELECT * FROM accounts Where username= '$name' and password='$sifre' ");
 //
 $stmt->execute();
 $kullaniciler = $stmt->fetchAll(PDO::FETCH_OBJ);

if($stmt->rowCount() > 0){
    $asd = $conn->prepare("INSERT INTO accounts (email, username, password, date, ip)
    VALUES ('$email', '$name', '$sifre','$tarih','$ip')");
    $asd->execute();
    echo 'giris basarili'; 
    include 'veriler.php';
    
}
else{
    echo 'Böyle bir kullanıcı bulunmamaktadır.';
}


?>
