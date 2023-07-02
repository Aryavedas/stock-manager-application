<?php
require("database.php");
class Barang
{
    private $_formItem = [];
    private $_pdo = NULL;
    private $_gambar_barang;

    public function __construct()
    {
        $this->_pdo = Database::getInstance();
    }

    public function validate($formMethod)
    {
        $validate = new Validate($formMethod);

        $this->_formItem["nama_barang"] = $validate->setRules("nama_barang", "Nama Barang", [
            "sanitize" => "string",
            "required" => TRUE,
            "min_char" => 4,
            "max_char" => 20
        ]);

        $this->_formItem["jumlah_barang"] = $validate->setRules("jumlah_barang", "Jumlah Barang", [
            "numeric"   => TRUE,
            "sanitize"  => "int",
            "min_value" => 1,
            "max_value" => 100
        ]);

        $this->_formItem["harga_barang"] = $validate->setRules("harga_barang", "Harga Barang", [
            "numeric"   => TRUE,
            "required"  => TRUE,
            "sanitize"  => "int",
            "min_value" => 0,
        ]);

        if (!$validate->passed()) {
            return $validate->getError();
        }
    }

    public function getItem($item)
    {
        return isset($this->_formItem[$item]) ? $this->_formItem[$item] : "";
    }

    public function setItem($key, $value)
    {
        switch ($key) {
            case 'gambar_barang':
                $this->_gambar_barang = $value;
                break;
        }
    }

    public function insert()
    {
        $new_barang = [
            "nama_barang"   => $this->getItem("nama_barang"),
            "jumlah_barang" => $this->getItem("jumlah_barang"),
            "harga_barang"  => $this->getItem("harga_barang"),
            "path"          => $this->_gambar_barang
        ];
        return $this->_pdo->Insert("barang", $new_barang);
    }


    public function generate($postValue)
    {
        $result = $this->_pdo->getWhereOnce("barang", ["id_barang", "=", $postValue]);
        foreach ($result as $key => $value) {
            $this->_formItem[$key] = $value;
        }
    }

    public function update($id_barang)
    {
        $new_barang = [
            "nama_barang" => $this->getItem("nama_barang"),
            "jumlah_barang" => $this->getItem("jumlah_barang"),
            "harga_barang" => $this->getItem("harga_barang")
        ];
        $this->_pdo->update("barang", $new_barang, ["id_barang", "=", $id_barang]);
    }

    public function delete($id_barang)
    {
        $this->_pdo->delete("barang", ["id_barang", "=", $id_barang]);
    }
}
