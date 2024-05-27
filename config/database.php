<?php
class database {
    private $host = "localhost";
    private $user = "root";
    private $database = "toko_buku_2";
    private $pass = "";
    private $konek;

    public function conn() {
        $this->konek = new mysqli($this->host, $this->user, $this->pass, $this->database);
    }

    public function data($query) {
        $result = $this->konek->query($query);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function execute($query, $params) {
        $stmt = $this->konek->prepare($query);
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $stmt->close();
    }

    public function close() {
        $this->konek->close();
    }
}
?>
