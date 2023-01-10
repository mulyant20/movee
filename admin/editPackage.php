<?php
include '../utils/connection.php';
include '../utils/utils.php';
require_once('isAdmin.php');


$id = $_GET['edit'];
$packages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM packages WHERE id = $id"));

if (isset($_POST['update'])) {
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
    <div class="fixed flex justify-between w-screen py-8 items-center p-8 text-white left-0 top-0 z-10">
        <p>Admin</p>
            <ul class="flex gap-6 text-white/40">
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
    <div class="max-w-[560px] h-fit1 mx-auto bg-white -mt-12 p-8 rounded-lg flex flex-col gap-8 mb-12">
        <p class="text-gray-800 font-semibold">Edit Paket Langganan</p>
        <form method="POST" action="#" class="flex flex-col w-full">
            <input value="<?= $packages['id'] ?>" hidden/>

            <label class="text-sm text-gray-500 font-semibold mb-2" for="Iname">Nama Paket</label>
            <input
                value="<?= $packages['name'] ?>"
                type="text"
                name="name"
                id="Iname"
                class="border border-gray-200 rounded outline-none py-2 px-4"
            />

            <div class="flex justify-between gap-2 mt-4">
                <div class="flex flex-col">
                    <label class="text-sm text-gray-500 font-semibold mb-2" for="ItotalPrice">Harga</label>
                    <input
                        value="<?= $packages['totalPrice'] ?>"
                        type="text"
                        name="totalPrice"
                        id="ItotalPrice"
                        class="border border-gray-200 rounded outline-none py-2 px-4"
                    />
                </div>
                <div class="flex flex-col">
                    <label class="text-sm text-gray-500 font-semibold mb-2" for="Idiscount">Diskon</label>
                    <input
                        value="<?= $packages['discount'] ?>"
                        type="text"
                        name="discount"
                        id="Idiscount"
                        class="border border-gray-200 rounded outline-none py-2 px-4"
                    />
                </div>
            </div>

            <label class="text-sm mt-4 text-gray-500 font-semibold mb-2" for="Idiscount">Jumlah Hari</label>
            <input
                value="<?= $packages['days'] ?>"
                type="text"
                name="days"
                id="Idays"
                class="border border-gray-200 rounded outline-none py-2 px-4"
            />
            
            <label class="text-sm mt-4 text-gray-500 font-semibold mb-2" for="devices">Jumlah Perangkat</label>
            <input
                value="<?= $packages['devices'] ?>"
                type="text"
                name="devices"
                id="devices"
                class="border border-gray-200 rounded outline-none py-2 px-4"
            />
            <button name="update" type="submit" id="btnSubmit" class="mt-4 bg-purple-800 py-2 text-white rounded">Update</button>
        </form>
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