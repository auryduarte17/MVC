<?php
class TareaModel {
    private $conn;
    private $table_name = "tareas";

    public function__construct($db)
    {
        $this->conn = $db;

    }
    //leer tareas
    public function leer(){
        $query = "SELECT id, tirulo, descrpcion, fecha_creacion, FROM " . $this->table_name . " ORDER BY fecha_creacion "
        &stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }
}
?>