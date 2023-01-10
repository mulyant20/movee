<?php
    include 'utils/connection.php';

    if (isset($_POST['register'])) {

        if(empty($_POST['email']) || empty($_POST['password'])) {
            echo "<script>alert(email tidak ada)</script>";
            header("Location: register.php");
            die();
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $hasEmailRegistered = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (!$result->num_rows > 0) {
            $result = mysqli_query(
                $conn,
                "INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$password')"
            );

            if ($result) {
                header("Location: createProfile.php?email='$email'");
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
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
        <h1 class="text-xl font-semibold mb-4">Sign up</h1>
        <form method="POST" action="#" class="flex flex-col relative">
            <label class="text-sm text-gray-500 font-semibold mb-2" for="Iemail">Email</label>
            <input 
                class="border border-gray-200 rounded-lg px-6 py-3 w-80 hover:outline-purple-800"
                type="email"
                name="email"
                id="Iemail"
            />

            <label class="text-sm mt-4 text-gray-500 font-semibold mb-2" for="password">Password</label>
            <input
                class="border border-gray-200 rounded-lg px-6 py-3 w-80 hover:outline-purple-800"
                type="text"
                name="password"
                id="password"
            />
            
            <label class="text-sm mt-4 text-gray-500 font-semibold mb-2" for="confirmPassword">Konfirmasi Password</label>
            <input
                class="border border-gray-200 rounded-lg px-6 py-3 w-80 hover:outline-purple-800"
                type="text"
                name="confirmPassword"
                id="confirmPassword"
            />
            <p class="absolute bottom-20 text-red-500" id="alertMessage"></p>
        
            <button
                name="register"
                type="submit"
                id="btnSubmit"
                class="bg-purple-800 text-white py-4 rounded mt-12"
            >
                Daftar Sekarang
            </button>
        </form>
        <p class="mt-4 text-gray-500">Sudah memiliki akun? masuk <a href="login.php" class="text-purple-800 font-semibold">Disini</a></p>
    </div>
    <div class="flex-1 bg-[#131116] flex flex-col items-center justify-center">
        <div class="w-[320px] max-w-full h-fit">
            <h1 class="text-white text-2xl leading-relaxed font-semibold capitalize">nikmati tayangan favoritmu dimana saja!</h1>
            <ul class="mt-4 flex flex-col gap-4">
                <li class="flex gap-2 items-center">
                    <i class='bx bx-shield text-lg text-emerald-400 font-semibold'></i>
                    <p class="text-white/70">Data kamu akan dijaga sebaik mungkin</p>
                </li>
                <li class="flex gap-2 items-start">
                    <i class='bx bx-data text-lg text-purple-400'></i>
                    <p class="text-white/70">Lebih dari 5rb tayangan yang bisa kamu tonton</p>
                </li>
                <li class="flex gap-2 items-start">
                    <i class='bx bxs-discount text-lg text-cyan-400'></i>
                    <p class="text-white/70">Dapatkan potongan harga hanya di movee</p>
                </li>
            </ul>
        </div>        
    </div>
</body>
<script>
    let alertMessage = document.getElementById('alertMessage')
    let inputPassword = document.getElementById('password')
    let inputConfirmPassword = document.getElementById('confirmPassword')
    let btnRegister = document.getElementById('btnSubmit')

    inputConfirmPassword.addEventListener("change", () => {
        if(inputPassword.value !== inputConfirmPassword.value) {
            btnRegister.disabled = true;
            btnRegister.classList.add('bg-purple-300')
            alertMessage.innerText = '*Password harus sama';
        } else {
            btnRegister.classList.remove('bg-purple-300')
            btnRegister.disabled = false;
            alertMessage.innerText = ''
        }
    })
    
    inputPassword.addEventListener("change", () => {
        if(inputPassword.value !== inputConfirmPassword.value) {
            btnRegister.disabled = true;
            btnRegister.classList.add('bg-purple-300')
            alertMessage.innerText = '*password harus sama';
        } else {
            btnRegister.disabled = false;
            btnRegister.classList.remove('bg-purple-300')
            alertMessage.innerText = ''
        }
    })
</script>
</html>