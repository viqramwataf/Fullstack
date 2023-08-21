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
    <?php
    include_once("class/Mahasiswa.php");
    include_once("class/Matakuliah.php");
    include_once("class/Peserta.php");
    // echo "<select name='matakuliah' id='matakuliah'>";

    // echo "</select>";
    echo "<form action='index.php' method='post'>";
    echo "<select name='matakuliah' id='matakuliah'>";
    $arrmk = Matakuliah::select("", "");
    if (isset($_POST) && !empty($_POST['matakuliah'])) {
        echo "<option value=''>---Pilih Mata Kuliah---</option>";
        load_index($arrmk, $_POST['matakuliah']);
    } else {
        echo "<option value=''>---Pilih Mata Kuliah---</option>";
        load_index($arrmk);
    }
    echo "</select>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";

    function load_index($arrmk = null, $selectedcode = "")
    {

        foreach ($arrmk as $mk) {
            # code...
            if ($mk['kode'] == $selectedcode) echo "<option value='{$mk['kode']}' selected >{$mk['nama']}</option>";
            else echo "<option value='{$mk['kode']}'>{$mk['nama']}</option>";
        }
    }



    echo "<table>";
    echo "<tr>";
    echo "<th>Nama Peserta</th>";

    $arrnilai = ["E", "D", "C", "BC", "B", "AB", "A"];
    foreach ($arrnilai as $nilai) {
        echo "<th>{$nilai}</th>";
    }
    echo "</tr>";

    echo "<tr>";
    $countmatkul = count($arrnilai) + 1;

    if (isset($_POST) && !empty($_POST['matakuliah'])) {
        $pesertamatkul = Peserta::select($_POST['matakuliah'], "", 0);

        if (sizeof($pesertamatkul) == 0) {
            echo "<tr>";
            echo "<td colspan='{$countmatkul}' style='text-align: center; font-size: 30px;'><b>NO DATA IS FOUND</b></td>";
            echo "</tr>";
        } else {
            foreach ($pesertamatkul as $peserta) {
                echo "<tr>";
                echo "<td>{$peserta['nrp']} - {$peserta['nama_mahasiswa']}</td>";

                $nilaipeserta = check_nilai($peserta['nilai']);
                foreach ($arrnilai as $nilai) {
                    // echo "<td>{$peserta['nilai']}</td>";
                    if ($nilai == $nilaipeserta) echo "<td>{$peserta['nilai']}</td>";
                    else echo "<td></td>";
                }
                echo "</tr>";
            }
        }
    } else {
        echo "<tr>";
        echo "<td colspan='{$countmatkul}' style='text-align: center; font-size: 30px;'><b>NO DATA IS FOUND</b></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><br>";


    // NA >= 81 ⇒ A
    // 73 <= NA < 81 ⇒ AB
    // 66 <= NA < 73 ⇒ B
    // 60 <= NA < 66 ⇒ BC
    // 55 <= NA < 60 ⇒ C
    // 40 <= NA < 55 ⇒ D
    // 0 <= NA < 40 ⇒ E
    function check_nilai($nilai): string
    {
        switch ($nilai) {
            case $nilai < 40:
                # code...
                return "E";
            case $nilai < 55:
                # code...
                return "D";
            case $nilai < 60:
                # code...
                return "C";
            case $nilai < 66:
                # code...
                return "BC";
            case $nilai < 73:
                # code...
                return "B";
            case $nilai < 81:
                # code...
                return "AB";
            case $nilai <= 100:
                # code...
                return "A";
            default:
                # code...
                break;
        }
    }
    ?>
    <button onclick="location.href='ubah_peserta.php'" type="button">
        Ubah Peserta</button>
</body>

</html>