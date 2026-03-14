<?php
class Database
{
    private $host = "localhost";
    private $dbname = "shopgiay";
    private $pass = "";
    private $conn;
    private $user = "root";
    public function __construct()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );
        if ($this->conn->connect_error) {
            die("Kết nối thất bại:" . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public function select($sql, $types = "", $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Lỗi prepare:" . $this->conn->error);
        }
        if ($types != "") {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();
        return $data;
    }

    public function execute($sql, $types = "", $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $success = $stmt->execute();
        if (!$success) {
            echo "Lỗi truy vấn:" . $stmt->error;
        }
        $stmt->close();
        return $success;
    }

    public function count($sql, $types = "", $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();
        return $total ?? 0;
    }
    public function close()
    {
        $this->conn->close();
    }
}
