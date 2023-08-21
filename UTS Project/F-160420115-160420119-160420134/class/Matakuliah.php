<?php
include_once("Koneksi.php");

class Matakuliah
{
    protected $kode;

    protected $nama;

    public function __construct($kode = "", $nama = "")
    {
        $this->kode = $kode;
        $this->nama = $nama;
    }

    public static function select($kode = "", $nama = "")
    {
        $kode = "%$kode%";
        $nama = "%$nama%";
        $sql = "select * from matakuliah where kode like ? and nama like ?";
        
        $koneksi = new Koneksi();
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ss", $kode, $nama);
        
        $stmt->execute();
        $result = $stmt->get_result();

        $returnarr = array();
        while ($matakuliah = $result->fetch_assoc()) {
            array_push($returnarr, $matakuliah);
            # code...
        }
        return $returnarr;
    }

    
}