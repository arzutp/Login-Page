<?php
    //session_start();
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'phplogin';
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
?>
<html>
<head>
    <meta charset='utf-8'>
<style>
table, th, td{
    border: 1px solid black;
    border-collapse: collapse; /*daha ince kenar için*/
    
    border-spacing: 5px;
}

#t01{
    width: 100%;
    background-color: brown;
}
</style>
</head>
<body>
<div id="arama">
    <form action="" method="get">
        <input type="text" name="arama" placeholder="Arama "/>
        <input type="submit" value="Ara" id="buton" name="ara"/>
    </form>
</div>
    <table>
        <tr>
        
            <td><a href="?username=DESC"><img src="down-arrow.svg" wight="10px" height="10px"></a> Kullanıcı Adı <a href="?username=ASC"><img src="up-arrow.svg" wight="10px" height="10px"></a></td>
            <td><a href="?email=DESC"><img src="down-arrow.svg" wight="10px" height="10px"></a> E Mail <a href="?email=ASC"><img src="up-arrow.svg" wight="10px" height="10px"></a></td>
            <td></td>
            <td></td>
        </tr>
        <?php

        $sorgu='';
        
        //sıralama işlemleri
        $usernameget = (!empty($_GET['username'])?$_GET['username']:0);
        if(!empty($usernameget)){
            $sorgu=' ORDER BY username '.$usernameget;
        }

        $emailget = (!empty($_GET['email'])?$_GET['email']:0);
        if(!empty($emailget)){
            $sorgu=' ORDER BY email '.$emailget;
        }

        //arama işlemi
        //SELECT DISTINCT * FROM accounts WHERE username LIKE 'e%'
        
        if(isset($_GET['ara'])){
            $arama = $_GET['arama'];
            
            if($arama){
                
                $sorgu = "WHERE username LIKE '%$arama%' OR email LIKE '%$arama%' ";    
            }
        }

        //verileri yazdırma işlemleri 
        $kullanicilar = $conn->prepare("SELECT DISTINCT email, username FROM accounts $sorgu"); //buraya sorgu ifadesini ekliyoruz boş olduğunda normal sorgu çalıştıracak
        $kullanicilar->execute();
        foreach ($kullanicilar as $kullanici) {
            //$id = $kullanici['id'];
                
                $email = $kullanici['email'];             
                $username = $kullanici['username'];
            
            ?>
            <tr>
           
            <td><?php echo $username; ?></td>
            <td><?php echo $email; ?></td> 
            <td><a href="edit.php?username=<?=$username;?>" class = "btn btn-danger" name="edit"> Düzenle</a></td>
                 
            <td><a href="islemler.php?username=<?=$username;?>" class = "btn btn-danger" name="sil"> Sil</a></td>
          </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>

