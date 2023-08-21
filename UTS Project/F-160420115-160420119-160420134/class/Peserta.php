<?php
include_once("Koneksi.php");
// namespace Class;

class Peserta
{
    protected $kode;

    protected $nrp;

    protected $nilai;

    public function __construct($kode, $nrp, $nilai)
    {
        $this->kode = $kode;
        $this->nrp = $nrp;
        $this->nilai = $nilai;
    }

    public static function select($kode = "", $nrp = "", $nilai = 0, $tandanilai = ">=")
    {
        $kode = "%$kode%";
        $nrp = "%$nrp%";
        $sql =
            "select 
        pe.kode, mt.nama as 'nama_matakuliah', 
        pe.nrp, mh.nama as 'nama_mahasiswa', 
        pe.nilai 
        from peserta as pe
        inner join mahasiswa as mh
        on pe.nrp = mh.nrp
        inner join matakuliah as mt
        on pe.kode = mt.kode
        where pe.kode like ? 
        and 
        pe.nrp like ? 
        and pe.nilai $tandanilai ? ";
        $koneksi = new Koneksi();

        $stmt = $koneksi->prepare($sql);

        $stmt->bind_param("ssi", $kode, $nrp, $nilai);

        $stmt->execute();

        $result = $stmt->get_result();

        $returnarr = array();

        while ($peserta = $result->fetch_assoc()) {
            array_push($returnarr, $peserta);
        }
        return $returnarr;
        # code...
    }

    public static function insertupdatedeleteALLINONEWOOOOOOOOOOOOO($kode = "", $nrp = "", $nilai = 0)
    {
        $sql = "";
        $koneksi = new Koneksi();
        $stmt = null;
        if ($nilai == 0 || $nilai == null || empty($nilai)) {
            $sql = "IF EXISTS (select * from peserta where kode=? and nrp=?) 
            THEN
                DELETE FROM peserta WHERE kode=? and nrp=?;
            END IF";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("ssss", $kode, $nrp, $kode, $nrp);
        }
        else {
            $sql = 
            "REPLACE INTO peserta
            (kode, nrp, nilai)
            VALUES
            (?, ?, ?);";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("ssi", $kode, $nrp, $nilai);
        }
        $stmt->execute();
        # code...
    }
}
