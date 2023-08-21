<?php
include_once("Koneksi.php");
class Mahasiswa
{
    protected $nrp;

    protected $nama;

    public function __construct($nrp = '', $nama = '')
    {
        $this->nrp = $nrp;
        $this->nama = $nama;
    }

    public static function select($nrp = '', $nama = '')
    {
        $nrp = "%$nrp%";
        $nama = "%$nama%";
        $sql = "select * from mahasiswa where nrp like ? and nama like ?";
        
        $koneksi = new Koneksi();
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ss", $nrp, $nama);
        $stmt->execute();
        $result = $stmt->get_result();
        $returnarr = array();
        while ($mahasiswa = $result->fetch_assoc()) {
            array_push($returnarr, $mahasiswa);
        }
        return $returnarr;
    }

    public static function insert($nrp, $nama)
    {
        
    }

    public static function update($nrp, $nama)
    {
        # code...
    }
}