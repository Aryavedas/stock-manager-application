<?php
class Database
{
    private $_host       = 'localhost';
    private $_dbname     = 'stock_manager';
    private $_username   = '';
    private $_password   = '';

    // Nilai Default Query
    private $_columnName = "*";
    private $_orderBy    = "";
    private $_count      = "0";

    // Prperty Koneksi Database
    private static $_instance = null;
    private $_pdo;

    private $queryWhere = "";
    private $condition = [];

    // Koneksi Database
    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname, $this->_username, $this->_password);
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }

    // Singeleton Koneksi database
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    // DateTime Value
    public function timeStamp()
    {
        $sekarang = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $result   = $sekarang->format("Y-m-d H:i:s");
        return $result;
    }

    // Parent Method Run Query Dengan STMT PDO / Menjalankan sebuah query
    public function runQuery(string $query, array $bindValue = [])
    {
        try {
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute($bindValue);
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
        return $stmt;
    }

    // GET QUERY Fetch Data Dari Run Query
    public function getQuery(string $query, array $bindValue = [])
    {
        return $this->runQuery($query, $bindValue)->fetchAll(PDO::FETCH_OBJ);
    }

    // Method utama untuk mengambil isi tabel
    public function get($tableName, $condition = "", $bindValue = [])
    {
        $query = "SELECT {$this->_columnName} FROM {$tableName} {$condition} {$this->_orderBy}";
        $this->_columnName = "*";
        $this->_orderBy = "";
        return $this->getQuery($query, $bindValue);
    }

    //Penulisan Query
    public function getCustom(string $tableName, array $bindValue = [])
    {
        if (empty($bindValue)) {
            $bindValue = $this->condition;
        }

        $query = "SELECT {$this->_columnName} FROM {$tableName} {$this->_orderBy}";
        $query .= $this->queryWhere ? " WHERE  {$this->queryWhere}" : "";
        $query = substr($query, 0, -3);

        // var_dump($query);die;
        $this->_columnName = "*";
        $this->_orderBy    = "";
        return $this->getQuery($query, $bindValue);
    }

    // Query SELECT
    public function select(string $columnName)
    {
        $this->_columnName = $columnName;
        return $this;
    }

    // Query Order By
    public function orderBy(string $columnName, string $orderBy = 'ASC')
    {
        $this->_orderBy = "ORDER BY {$columnName} {$orderBy}";
        return $this;
    }

    // Query GET WHERE
    public function getWhere(string $tableName, array $condition = [])
    {
        if (empty($condition)) {
            return $this->getCustom($tableName);
        } else {
            $queryCondition = "WHERE {$condition[0]} {$condition[1]} ? ";
            return $this->get($tableName, $queryCondition, [$condition[2]]);
        }
    }

    //GET WHERE Once
    public function getWhereOnce(string $tableName, array $condition)
    {
        $result = $this->getWhere($tableName, $condition);
        if (!empty($result)) {
            return $result[0];
        } else {
            return FALSE;
        }
    }

    //Penulisan Query
    public function getChaining(string $tableName, string $condition = "", array $bindValue = [])
    {
        $query = "SELECT {$this->_columnName} FROM {$tableName} {$this->_orderBy} {$condition}";
        $this->_columnName = "*";
        $this->_orderBy    = "";
        return $this->getQuery($query, $bindValue);
    }

    // Get Like
    // public function getLike(string $tablename, string $columnName, array $condition)
    // {
    //     $queryLike = "WHERE {$columnName} LIKE ?";
    //     return $this->getCustom($tablename, $queryLike, ['%' . $condition[0] . '%']);
    // }

    public function orLike(string $columnName, string $condition)
    {
        $queryLike = "";
        $this->queryWhere ? $queryLike .= " OR " : "";
        $queryLike = "{$columnName} LIKE ? OR ";
        $this->queryWhere .= $queryLike;
        array_push($this->condition, "%" . $condition . "%");
        return $this;
    }

    //Get Check
    public function getCheck(string $columnName, string $tableName, string|int $condition)
    {
        $queryCheck = "SELECT {$columnName} FROM {$tableName} WHERE {$columnName} = ?";
        return $this->runQuery($queryCheck, [$condition])->rowCount();
    }

    // Query Insert
    public function insert(string $tableName, array $dataValue)
    {
        $arrayKeys    = array_keys($dataValue);
        $arrayValues  = array_values($dataValue);
        $placeHolder  = str_repeat("?,", count($arrayValues) - 1) . "?";
        $queryInsert  = "INSERT INTO {$tableName} " . "(" . implode(", ", $arrayKeys) . ")" . " VALUES ({$placeHolder})";
        $this->_count = $this->runQuery($queryInsert, $arrayValues)->rowCount();
        return TRUE;
    }
    public function count()
    {
        return $this->_count;
    }

    //Query Update
    public function update(string $tableName, array $data, array $condition)
    {
        $queryUpdate = "UPDATE {$tableName} SET ";
        foreach ($data as $key => $value) {
            $queryUpdate .= "$key = ?, ";
        }
        $queryUpdate = substr($queryUpdate, 0, -2);
        $queryUpdate .= " WHERE {$condition[0]} {$condition[1]} ?";

        $placeHolder = array_values($data);
        array_push($placeHolder, $condition[2]);

        $this->_count = $this->runQuery($queryUpdate, $placeHolder)->rowCount();
        return TRUE;
    }

    // QUERY DELETE
    public function delete(string $tableName, array $condition)
    {
        $queryDelete = "DELETE FROM {$tableName} WHERE {$condition[0]} {$condition[1]} ?";
        $this->_count = $this->runQuery($queryDelete, [$condition[2]])->rowCount();
        return TRUE;
    }

    // Method untuk check nilai unik, akan berguna untuk form
    public function check($tableName, $columnName, $dataValues)
    {
        $query = "SELECT {$columnName} FROM {$tableName} WHERE {$columnName} = ? ";
        return $this->runQuery($query, [$dataValues])->rowCount();
    }
}
