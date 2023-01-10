<?php
include 'utils/connection.php';
include 'utils/utils.php';

$packages = mysqli_query($conn, "SELECT * FROM packages");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Langganan</title>
</head>
<body class="bg-[#131116]">
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
                    <img src="./assets/images/<?= $_SESSION['image'] ?>" class="h-8 w-8 rounded-full"/>
                <?php else : ?>
                    <a href="login.php" class="block px-6 py-2 rounded bg-purple-800 text-white">Masuk</a>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="container mx-auto flex flex-col md:flex-row justify-between w-full h-fit mt-16">
        <div class="flex-1 p-12 pt-20">
            <h1 class="font-semibold text-white text-2xl mb-4">Nonton Lebih Puas, Lebih Banyak di Movee</h1>
            <p class="text-white/40 max-w-[380px] leading-relaxed">Nikmati semua film tanpa batas dan download film kesukaanmu!</p>
        </div>
        <div class="flex-1 flex flex-col gap-4 p-12">
            <?php while ($package = mysqli_fetch_array($packages)) : ?>
                <div class="bg-slate-800 hover:bg-gray-700 px-12 py-8 rounded-lg hover:shadow-gray-200 duration-150 ease-in text-white">
                    <div class="flex justify-between">
                        <a href="payment.php?id=<?= $package['id'] ?>" class="text-xl font-semibold mb-4"><?= $package['name'] ?></a>
                        <div class="flex flex-col items-end">
                            <p class="text-3xl mb-2">Rp. <?= getPrice($package['totalPrice'], $package['discount']) ?></p>
                            <p class="text-sm">(<?= getPerDay($package['totalPrice'], $package['days']) ?> per hari)</p>
                        </div>
                    </div>
                    <ul class="-mt-4 list-inside">
                        <li class="text-gray-400 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <p><?= $package['days'] ?> hari</p>
                        </li>
                        <li class="text-gray-400 flex items-center gap-2">
                            <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <p><?= $package['devices'] ?> perangkat</p>
                        </li>
                    </ul>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>