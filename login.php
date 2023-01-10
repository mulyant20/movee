<?php
    include 'utils/connection.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $isUserRegistered = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");

        if ($isUserRegistered->num_rows > 0) {
            $user = mysqli_fetch_assoc($isUserRegistered);

            session_start();
            $_SESSION['idUser'] =$user['id'];
            $_SESSION['image'] = $user['profileImage'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['hasLogin'] = true;

            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="flex justify-between">
    <div class="flex-1 h-screen flex flex-col justify-center items-center">
        <h1 class="text-xl font-semibold mb-4">Login</h1>
        <form name="login" method="post" class="flex flex-col relative">
            <label class="text-sm text-gray-500 font-semibold mb-2" for="Iemail">Email</label>
            <input
                class="border border-gray-200 rounded-lg px-6 py-3 w-80 hover:outline-purple-800"
                type="text"
                name="email"
                id="Iemail"
            />

            <label class="text-sm mt-4 text-gray-500 font-semibold mb-2" for="Ipassword">Password</label>
            <input
                class="border border-gray-200 rounded-lg px-6 py-3 w-80 hover:outline-purple-800"
                type="text"
                name="password"
                id="Ipassword"
            />
            <button
                class="bg-purple-800 text-white py-4 rounded mt-12 font-semibold"
                name="login"
                type="submit"
            >
                Masuk
            </button>
        </form>
        <p class="mt-4 text-gray-500">Belum memiliki akun? Daftar <a href="register.php" class="text-purple-800 font-semibold">Disini</a></p>
    </div>
    <div class="flex-1 bg-[#131116] flex flex-col items-center justify-center">
        <div class="w-[320px] max-w-full h-fit">
            <div class="bg-gray-100/10 w-12 h-12 rounded flex items-center justify-center mb-4">
                <i class='bx bxs-cube-alt text-xl text-sky-400'></i>
            </div>
            <h1 class="text-white text-2xl leading-relaxed font-semibold capitalize">Selamat Datang, kembali!</h1>
            <p class="text-white/40 mt-4">Kami punya info penting untuk, sekarang movee punya tayangan baru yang bakal menarik untuk kamu tonton sekarang</p>
            
        </div>        
    </div>
</body>
</html>
