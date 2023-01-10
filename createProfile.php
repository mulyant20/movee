<?php
include "utils/connection.php";
include "utils/upload.php";


if (isset($_POST['create'])) {
    $email = trim($_GET['email'], "'");
    $username = $_POST['Iusername'];
    $gambar = upload();

    if ($gambar) {
        mysqli_query(
            $conn,
            "UPDATE users
                SET 
                    username = '$username',
                    profileImage = '$gambar'
                WHERE 
                    email = '$email'"
        );
    } else {
        mysqli_query(
            $conn,
            "UPDATE users
                SET 
                    username = '$username',
                    profileImage = 'default.jpg'
                WHERE 
                    email = '$email'"
        );
    }

    session_start();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['image'] = $gambar;
    $_SESSION['hasLogin'] = true;

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f5f5]">
    <div class="w-screen py-4 border-b border-gray-200 bg-white">
        <div class="max-w-[600px] mx-auto">
            <p class="text-purple-800 font-semibold">Movee</p>
        </div>
    </div>
    <div class="max-w-[600px] mx-auto h-fit mt-12">
        <p class="text-xl font-semibold text-gray-800 mb-4">Buat Profil</p>
        <form method="POST" action="#" enctype="multipart/form-data" class="flex flex-col">
            
            <label
                class="text-sm mt-4 text-gray-500 font-semibold mb-2"
                for="Iusername">
                Username
            </label>
            <input
                class="w-full border border-gray-200 rounded-lg px-6 py-3 hover:outline-purple-800"
                type="text"
                placeholder="username"
                name="Iusername"
                id="Iusername"
            />

            <label
                class="text-sm mt-4 text-gray-500 font-semibold mb-2"
                for="Iprofile">
                Unggah Photo Profile
            </label>
            <div class="mb-8 w-full flex items-center justify-center py-8 rounded-lg border-2 border-gray-400 border-dashed">
                <input type="file" name="image" id="Iprofile" />                
            </div>
            
            <button
                class="bg-purple-800 font-semibold text-white py-4 rounded mt-4 block px-12 ml-auto"
                name="create"
                type="submit"
                id="btnSubmit"
            >
                Buat
            </button>
        </form>
    </div>
</body>

</html>