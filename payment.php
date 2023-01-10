<?php
include 'utils/connection.php';
include 'utils/utils.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getPackage = mysqli_query($conn, "SELECT * from packages WHERE id = $id");
    $package = mysqli_fetch_assoc($getPackage);
}

if (isset($_POST['bayar'])) {
    session_start();
    $idUser = $_SESSION['idUser'];
    $idPackage = $_POST['id'];
    $date = $_POST['date'];

    mysqli_query(
        $conn,
        "UPDATE users SET
            hasSubscribe = $idPackage,
            dateSubscribe = '$date'
        WHERE
            id = $idUser"
    );

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f5f5]">
    <div class="container mx-auto flex justify-between p-12 gap-8">
        <div class="flex-1 rounded-lg p-8">
            <h1 class="mb-8 text-3xl font-semibold text-gray-800"><?= $package['name'] ?> <span class="text-sm font-normal text-gray-600"><?= $package['days'] ?> hari</span></h1>
            <p class="text-md font-semibold mb-4">Pilih Metode Pembayaran</p>
            <ul class="flex flex-col gap-4 text-gray-500">
                <li class="flex justify-between p-3 px-6 rounded border border-gray-300">
                    <label for="ovo" class="w-full cursor-pointer">ovo</label>
                    <input type="radio" id="ovo" value="ovo" name="method"/>
                </li>
                <li class="flex justify-between p-3 px-6 rounded border border-gray-300">
                    <label for="dana" class="w-full cursor-pointer">dana</label>
                    <input type="radio" id="dana" value="dana" name="method"/>
                </li>
                <li class="flex justify-between p-3 px-6 rounded border border-gray-300">
                    <label for="shopeepay" class="w-full cursor-pointer">shopeePay</label>
                    <input type="radio" id="shopeepay" value="shopeepay" name="method"/>
                </li>
                <li class="flex justify-between p-3 px-6 rounded border border-gray-300">
                    <label for="alfamart" class="w-full cursor-pointer">alfamart</label>
                    <input type="radio" id="alfamart" value="alfamart" name="method"/>
                </li>
            </ul>
            <form name="bayar" method="post">
                <input type="id" name="id" id="Iid" value="<?= $id ?>" hidden />
                <input type="date" name="date" id="Idate" hidden />
                <button name="bayar" type="submit" class="mt-8 w-full py-3 bg-yellow-400 text-gray-800 font-semibold rounded">Konfirmasi Pembayaran</button>
            </form>
        </div>
        <div class="flex-1 pt-12">
            <div class="max-w-[400px] mx-auto bg-white p-12 rounded-lg border border-gray-300 mt-12">
                <p class="text-gray-400 mb-4">Total Bayar</p>
                <p class="text-3xl text-gray-800" id="price">Rp. <?= getPrice($package['totalPrice'], $package['discount']) ?></p>
                <div class="mt-8">
                    <p class="text-sm mb-2 text-gray-400">Tambah Kupon</p>
                    <input id="coupon" class="bg-gray-100/40 rounded border outline-none border-gray-200 w-full py-2 px-4" />
                </div>
            </div>
        </div>
    </div>
    <script>
        const Idate = document.getElementById('Idate')
        const PriceP = document.getElementById('price')
        const Icoupon = document.getElementById('coupon')
        const temp = PriceP.innerText
        const defaultValue = PriceP.innerText.slice(4).replace('.', '')

        Icoupon.addEventListener('change', () => {
            switch(Icoupon.value) {
                case 'OFF5':
                    let price5 = updatePrice(defaultValue, 5)
                    PriceP.innerHTML = price5
                    break
                case 'OFF10':
                    let price10 = updatePrice(defaultValue, 10)
                    PriceP.innerHTML = price10
                    break
                default:
                    PriceP.innerHTML = temp
                    break
            }
        })
        
        document.addEventListener("DOMContentLoaded", () => {
            const currDate = new Date().toISOString().slice(0, 10)
            Idate.value = currDate
        })

        const updatePrice = (price, discount) => {
            const disc = (discount/100)*price
            return rupiah(price - disc)
        }

        const rupiah = (number)=>{
            const formatter = new Intl.NumberFormat('id')
            const formattedValue = `Rp. ${formatter.format(number)}`
            return formattedValue
        }
    </script>
</body>

</html>