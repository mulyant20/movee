<?php
include '../utils/connection.php';
include '../utils/utils.php';
require_once('isAdmin.php');

$packages = mysqli_query($conn, "SELECT * FROM packages");

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $totalPrice = $_POST['totalPrice'];
    $discount = $_POST['discount'];
    $days = $_POST['days'];
    $devices = $_POST['devices'];

    mysqli_query(
        $conn,
        "INSERT INTO packages (name, totalPrice, discount, days, devices)
            VALUES ('$name', $totalPrice, $discount, $days, $devices)"
    );

    header("refresh:2");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $totalPrice = $_POST['totalPrice'];
    $discount = $_POST['discount'];
    $days = $_POST['days'];
    $devices = $_POST['devices'];

    mysqli_query($conn, "UPDATE packages
            SET
                name = '$name',
                totalPrice = $totalPrice,
                discount = $discount,
                days = $days,
                devices = $devices
            WHERE
                id = $id;  
        ");

    header("refresh:2");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM packages WHERE id = $id");
    header("Location: packages.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-[#f5f5f5]">
    <div class="fixed flex justify-between w-screen py-8 items-center bg-[#131116] p-8 text-white left-0 top-0 z-10">
        <p>Admin</p>
        <ul class="flex gap-6 text-white/40">
            <li>
                <a href="dashboard.php" class="block py-2 px-4 rounded hover:text-white hover:bg-white/20">Dashboard</a>
            </li>
            <li>
                <a href="packages.php" class="block py-2 px-4 rounded hover:text-white hover:bg-white/20">Paket Langganan</a>
            </li>
            <li>
                <a href="report.php" class="block py-2 px-4 rounded hover:text-white hover:bg-white/20">Cetak Laporan</a>
            </li>
        </ul>
    </div>
    <!-- main -->
    <div class="bg-[#131116] h-56 min-w-screen">
    </div>
    <div class="max-w-[800px] h-fit mx-auto -mt-12 rounded-lg flex flex-col gap-8 pb-20">
        <?php while ($package = mysqli_fetch_array($packages)) : ?>
            <div class="bg-white px-12 py-8 rounded-lg hover:shadow-gray-200 duration-150 ease-in text-gray-800 relative card">
                <div class="flex justify-between">
                    <a href="payment.php?id=<?= $package['id'] ?>" class="text-xl font-semibold mb-4"><?= $package['name'] ?></a>
                    <div class="flex flex-col items-end">
                        <p class="text-3xl mb-2">Rp. <?= getPrice($package['totalPrice'], $package['discount']) ?></p>
                        <p class="text-sm">(<?= getPerDay($package['totalPrice'], $package['days']) ?> per hari)</p>
                    </div>
                </div>
                <ul class="-mt-4 list-inside">
                    <li class="text-gray-400 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p><?= $package['days'] ?> hari</p>
                    </li>
                    <li class="text-gray-400 flex items-center gap-2">
                        <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p><?= $package['devices'] ?> perangkat</p>
                    </li>
                </ul>
                <div class="absolute bottom-6 right-12 edit duration-150 ease-in">
                    <a href="editPackage.php?edit=<?= $package['id'] ?>">
                        <i class='bx bxs-edit-alt'></i>
                    </a>
                    <a href="?hapus=<?= $package['id'] ?>">
                        <i class='bx bxs-trash'></i>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="w-full flex justify-end items-center">
            <button class="px-8 py-2 rounded bg-purple-800 text-white paket baru" id="btnCreate">Buat Paket Baru</button>
        </div>
    </div>
    <div class="modal hidden w-screen h-screen fixed top-0 left-0 bg-slate-900/10 items-center justify-center z-20">
        <div class="bg-white w-[600px] max-w-full h-fit p-12 rounded-lg">
            <div class="flex justify-between">
                <p class="text-xl font-semibold text-gray-800 mb-8">Paket baru</p>
                <button class="w-8 h-8 rounded-full hover:bg-gray-100 text-gray-800 text-red-400 text-sm flex justify-center items-center hover:text-red-600 font-semibold" id="btnClose">X</button>
            </div>
            <form method="POST" action="#" class="flex flex-col w-full">
                <label class="text-sm text-gray-500 font-semibold mb-2" for="Iname">Nama paket</label>
                <input class="border border-gray-200 rounded-lg px-6 py-3 hover:outline-purple-800" type="text" name="name" id="Iname" />

                <div class="w-full flex justify-between gap-4 mt-4">
                    <div class="flex flex-col">
                        <label class="text-sm text-gray-500 font-semibold mb-2" for="ItotalPrice">Harga paket</label>
                        <input type="text" name="totalPrice" id="ItotalPrice" class="border border-gray-200 rounded-lg px-6 py-3 hover:outline-purple-800" />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm text-gray-500 font-semibold mb-2" for="Idiscount">Diskon</label>
                        <input type="text" name="discount" id="Idiscount" class="border border-gray-200 rounded-lg px-6 py-3 hover:outline-purple-800" />
                    </div>
                </div>
                <label class="text-sm text-gray-500 font-semibold mb-2 mt-4" for="Idays">Hari</label>
                <input type="text" name="days" id="Idays" class="border border-gray-200 rounded outline-none py-2 px-4" />
                
                <label class="text-sm text-gray-500 font-semibold mb-2 mt-4" for="devices">Perangkat</label>
                <input type="text" name="devices" id="devices" class="border border-gray-200 rounded outline-none py-2 px-4" />
                
                <button name="create" type="submit" id="btnSubmit" class="bg-purple-800 text-white py-4 rounded mt-4 font-semibold">Buat</button>
            </form>
        </div>
    </div>
    <script>
        const btnCreate = document.getElementById('btnCreate')
        const btnClose = document.getElementById('btnClose')
        const modal = document.querySelector('.modal')

        btnCreate.addEventListener('click', () => {
            modal.classList.toggle('hidden')
            modal.classList.toggle('flex')
        })

        btnClose.addEventListener('click', () => {
            modal.classList.toggle('hidden')
            modal.classList.toggle('flex')
        })
    </script>
</body>

</html>