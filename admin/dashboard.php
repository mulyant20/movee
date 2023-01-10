<?php
    require_once('isAdmin.php');
    include '../utils/connection.php';

    $users = mysqli_query($conn, "SELECT users.*, packages.name AS namePackages FROM users LEFT JOIN packages ON packages.id = users.hasSubscribe");
    $subsribers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as Subs FROM users WHERE hasSubscribe IS NOT NULL"));
    $packages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as allPackages FROM packages"));
    $countUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) AS allUser from users"));

    if(isset($_GET['cari'])) {
        $search = $_GET['Iname'];

        $searches = mysqli_query($conn, "SELECT users.*, packages.name AS namePackages FROM users LEFT JOIN packages ON packages.id = users.hasSubscribe WHERE users.username LIKE '%$search%'");
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
    <div class="max-w-[800px] mx-auto h-fit -mt-12 relative z-10">
        <div class="w-full rounded-lg">
            <div class="flex justify-between gap-8 mb-8">
                <div class="flex-1 border border-gray-200 bg-white h-40 rounded-lg flex flex-col justify-center items-center">
                    <p class="text-3xl font-semibold mb-2"><?= $subsribers['Subs'] ?></p>
                    <p class="text-sm text-gray-400">Jumlah Pelanggan</p>
                </div>
                <div class="flex-1 border border-gray-200 bg-white h-40 rounded-lg flex flex-col justify-center items-center">
                    <p class="text-3xl font-semibold mb-2"><?= $packages['allPackages'] ?></p>
                    <p class="text-sm text-gray-400">Paket tersedia</p>
                </div>
                <div class="flex-1 border border-gray-200 bg-white h-40 rounded-lg flex flex-col justify-center items-center">
                    <p class="text-3xl font-semibold mb-2"><?= $countUser['allUser'] ?></p>
                    <p class="text-sm text-gray-400">Jumlah User</p>
                </div>
            </div>
            <div class="w-full h-fit overflow-y-auto bg-white rounded-lg p-8">
                <div class="flex justify-end items-center mb-6">
                    <div>
                        <form name="cari">
                            <input class="w-80 py-2 px-4 border border-gray-200 rounded" placeholder="cari berdasar nama" name="Iname" />
                            <input type="submit" name="cari" hidden />
                        </form>
                    </div>
                </div>
                <table class="w-full">
                  <thead>
                    <tr class="h-12 border-b border-gray-200">
                      <th>No</th>
                      <th class="text-left">Username</th>
                      <th class="text-left">Email</th>
                      <th class="text-left">Paket</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $num = 0; ?>
                    <?php if(isset($_GET['cari'])) : ?>
                        <?php if($searches->num_rows > 0) : ?>
                            <?php while($user = mysqli_fetch_array($searches)) : ?>
                                <tr class="h-12 hover:bg-slate-200">
                                    <td class="text-center"><?= ++$num ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['namePackages'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr class="h-12 hover:bg-slate-200">
                                <td colspan="4" class="text-center">Data Yang Kamu Cari Tidak Ada</td>
                            </tr>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php while($user = mysqli_fetch_array($users)) : ?>
                            <tr class="h-12 hover:bg-slate-200">
                                <td class="text-center"><?= ++$num ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['namePackages'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
