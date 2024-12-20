<?php 
session_start() 
?>

<?php 
    include('conn/koneksi.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "Mail/src/Exception.php";
    require "Mail/src/PHPMailer.php";
    require "Mail/src/SMTP.php";

    if(isset($_POST["recover"])){
        include('conn/koneksi.php');
        $email = $_POST["email"];

        $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE email='$email'");
        $query = mysqli_num_rows($sql);
        $fetch = mysqli_fetch_assoc($sql);
        $name = $fetch["nama"];

        if(mysqli_num_rows($sql) <= 0){
            echo "<script>alert('Maaf, tidak ada akun yang terdaftar dengan email tersebut / alamat email tidak valid!')</script>";
        }else if($fetch["verif"] == 0){
            echo "<script>alert('Maaf, anda harus memverifikasi akun anda terlebih dahulu sebelum memulihkan kata sandi!')</script>";
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            
            $mail = new PHPMailer();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='raihanadepurnomo123@gmail.com';
            $mail->Password='qeaobdtupijicoqf';

            // send by h-hotel email
            $mail->setFrom('raihanadepurnomo123@gmail.com', 'ADUIN');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Memulihkan Kata Sandi Anda";
            $mail->Body="<b>Kepada $name</b>
            <h3>Kami menerima anda meminta untuk mengubah kata sandi.</h3>
            <p>Silahkan masukkan Kode verifikasi pemulihan akun anda $otp</p>
            <br><br>
            <p>Regards</p>
            <b>ADUIN - RPL KEL 3</b>";

            if(!$mail->send()){ 
                echo "<script>alert('Alamat Email Tidak Valid!')</script>";
            }else{
                ?>
                    <script>
                        window.location.replace("verifikasi_lupa_password.php");
                    </script>
                <?php
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Pemulihan Kata Sandi</title>
    <link rel="stylesheet" href="css/lupa_password.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="icon" href="../image/forget.png">
</head>

<body>
    <div class="box">
        <div class="form">
            <form action="#" method="POST">
                <h2>Lupa Kata Sandi?</h2>
                    <div class="inputBox">
                        <input type="text" id="email_address" name="email" required="required" autocomplete="off">
                        <span>Email</span>
                        <i></i>
                    </div>
                    <br>
                    <input type="submit" value="Pulihkan" name="recover">
                    <br>
                    <br>
                    <div class="cr">
                        <p align="center">Sudah ingat kata sandi? </p>
                        <br>
                        <a align="center" href="cek.php">Masuk disini</a>
                    </div>
                </form>
        </div>
    </div>
</body>
