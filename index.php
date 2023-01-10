<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Movee</title>
</head>
<body class="bg-[#131116] pb-20">
    <!-- navbar -->
    <div class="w-screen py-4 fixed top-0 left-0 z-20">
        <div class="container mx-auto flex justify-between">
            <p class="text-white font-semibold">Movee</p>
            <ul class="flex gap-12 text-white/80 items-center">
                <li>
                    <a href="index.php">Beranda</a>
                </li>
                <li>
                    <a href="subscribe.php">Langganan</a>
                </li>
                <li>
                <?php if(isset($_SESSION['hasLogin'])) : ?>
                    <a href="./utils/logout.php" class="flex rounded-full items-center gap-4 p-2 pl-3 border border-white/20">
                        <p><?= $_SESSION['username'] ?></p>
                        <img src="./assets/images/<?= $_SESSION['image'] ?>" class="h-8 w-8 rounded-full"/>
                    </a>
                <?php else : ?>
                    <a href="login.php" class="block px-6 py-2 rounded bg-purple-800 text-white">Masuk</a>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <!-- heading -->
    <div class="w-full h-[600px] overflow-hidden relative">
        <div class="absolute w-full h-full bg-gradient-to-t from-[#131116] to-[#131116]/0"></div>
        <img src="https://image.tmdb.org/t/p/original/iHSwvRVsRyxpX7FE7GbviaDvgGZ.jpg" class="w-full object-contain">
        <div class="absolute bottom-24 left-20 z-10">
            <h1 class="text-[4rem] text-white font-semibold mb-4">Wednesday</h1>
            <p class="text-white/50 max-w-[700px] leading-relaxed">Wednesday Addams is sent to Nevermore Academy, a bizarre boarding school where she attempts to master her psychic powers, stop a monstrous killing spree of the town citizens, and solve the supernatural mystery that affected her family 25 years ago — all while navigating her new relationships.</p>
        </div>
    </div>
    <div class="container mx-auto -mt-12 mx-auto w-full grid grid-cols-[repeat(auto-fill,minmax(theme(width.80),1fr))] gap-8 movie1"></div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="module">
        import {getMovies} from './assets/js/utils.js'
        import request from './assets/js/requests.js'
        
        const movie1 = document.querySelectorAll('.movie1')

        document.addEventListener("DOMContentLoaded", () => {
            getMovies(request.basic, movie1[0])
        })
    </script>

    <?php
        include 'utils/hasLogin.php';
    ?>
</body>
</html>