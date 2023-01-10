<?php
$secret = 12345;
if (isset($_POST['submit'])) {
    $password = (int) $_POST['password'];
    if ($password === $secret) {
        session_start();
        $_SESSION['isAdmin'] = true;
        header("Location: dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#131116] flex justify-center items-center min-h-screen">
    <form method="POST" name="submit" class="flex flex-col gap-4">
        <label class="text-sm mt-4 text-white/70 font-semibold mb-2" for="Ipassword">Masukan Kata kunci</label>
        <input
            class="bg-[#131116] text-white/70 border border-white/20 outline-none rounded-lg px-6 py-3 w-80"
            type="password"
            name="password"
        />
        <button type="submit" name="submit" hidden>Login</button>
    </form>    
</body>
</html>
