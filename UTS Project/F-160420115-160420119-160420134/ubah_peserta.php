<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid;
            border-color: black;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>
    <table>
        <?php
        include_once("class/Mahasiswa.php");
        include_once("class/Matakuliah.php");
        include_once("class/Peserta.php");
        include_once("class/load_ubah_peserta_table.php");

        if (isset($_POST) && sizeof($_POST) != 0) {
            foreach ($_POST as $kodenrp => $nilai) {
                $arrkodenrp = explode("-", $kodenrp);
                Peserta::insertupdatedeleteALLINONEWOOOOOOOOOOOOO($arrkodenrp[0], $arrkodenrp[1], $nilai);
            }
            load_ubah_peserta_table("ubah_peserta.php");
            echo "<br><br><b>Sukses menambahkan data!</b>";
            // ini function magicnya
            // coba liat "class/load_ubah_peserta_table.php" kalo pengen pusing
            // selamat debugging :))))))
        } else {
            load_ubah_peserta_table("ubah_peserta.php");
        }
        ?>
    </table>
    <br><br>
    <button onclick="location.href='index.php'" type="button">
        Back To Menu</button>
</body>

</html>