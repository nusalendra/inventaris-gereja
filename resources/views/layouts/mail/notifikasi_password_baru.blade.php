<!DOCTYPE html>
<html>

<head>
    <title>Pelatihan Baru Dibuat Untuk Anda Sebagai Narasumber</title>
</head>

<body>
    <p>Halo {{ $dataUser['name'] }},</p>
    <p>Kami telah menerima permintaan untuk mereset password Anda. Berikut adalah password baru yang dapat Anda gunakan
        untuk masuk ke akun Anda :</p>
    <p><strong>Password Baru : </strong> {{ $dataUser['passwordBaru'] }}</p>
    <p>Untuk keamanan akun Anda, kami sarankan untuk segera mengganti password ini setelah berhasil masuk.</p>
    <br>
    <p><strong>Salam,</strong></p>
    <p><strong>Kerapatan Gereja Protestan Minahasa</strong></p>
    <hr>
    <p><i>Ini adalah email yang dikirimkan oleh sistem. Mohon untuk tidak membalas email ini.</i></p>
</body>

</html>
