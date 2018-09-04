<?php

class DB_driver {

    // Biến lưu trữ kết nối
    private $conn;

    // Hàm Kết Nối
    function connect() {
        // Nếu chưa kết nối thì thực hiện kết nối
        if (!$this->conn) {
            // Kết nối
            $this->conn = mysqli_connect('localhost', 'root', '', 'webtintuc') or die('Lỗi kết nối');

            // Xử lý truy vấn UTF8 để tránh lỗi font
            mysqli_query($this->conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        }
    }

    // Hàm Ngắt Kết Nối
    function disconnect() {
        // Nếu đang kết nối thì ngắt
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }

    // Hàm Insert
    function insert($table, $data) {
        // Kết nối
        $this->connect();

        // Lưu trữ danh sách row
        $row = array();
        // Lưu trữ danh sách giá trị tương ứng với row
        $value_list = array();

        // Lặp qua data
        foreach ($data as $key => $value) {
            $row[] = $key;
            $value_list[] = "'".$value."'";
        }

        // Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = "INSERT INTO ". $table ."(". implode(',' ,$row) .")
                    VALUES (". implode(',' , $value_list) .")";

        return mysqli_query($this->conn, $sql);
    }

    // Hàm Update
    function update($table, $data, $where) {
        // Kết nối
        $this->connect();
        // Lặp qua data
        foreach ($data as $key => $value) {
            $set[] = $key."='".$value."'" ;
        }
        $set = implode(',',$set);    
        // Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = "UPDATE ".$table." SET ".$set." WHERE ".$where ;

        return mysqli_query($this->conn, $sql);
    }

    // Hàm delete
    function delete($table, $where) {
        // Kết nối
        $this->connect();

        // Delete
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->conn, $sql);
    }

    // Hàm lấy danh sách
    function get_list($sql) {
        // Kết nối
        $this->connect();

        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die('Câu truy vấn bị sai');
        }

        $return = array();

        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }

        // Xóa kết quả khỏi bộ nhớ
        mysqli_free_result($result);

        return $return;
    }

    // Hàm lấy 1 record dùng trong trường hợp lấy chi tiết tin
    function get_row($sql) {
        // Kết nối
        $this->connect();

        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die('Câu truy vấn bị sai');
        }

        $row = mysqli_fetch_assoc($result);

        // Xóa kết quả khỏi bộ nhớ
        mysqli_free_result($result);

        if ($row) {
            return $row;
        }

        return false;
    }

}
?>

