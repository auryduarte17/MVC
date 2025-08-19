<?php
class TareaModel
{
    private $conn;
    private $table_name = "tareas";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    //leer tareas
    public function leer()
    {
        $query = "SELECT id, titulo, descripcion, fecha_creacion FROM " . $this->table_name . "WHERE estado = 1 ORDER BY fecha_creacion DESC ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //crear tarea
    public function crear($titulo, $descripcion)
    {
        $query = "INSERT INTO " . $this->table_name . " SET titulo =:titulo, descripcion =:descripcion";
        $stmt = $this->conn->prepare($query);

        $titulo = htmlspecialchars(strip_tags($titulo));
        $descripcion = htmlspecialchars(strip_tags($descripcion));

        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descripcion", $descripcion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    //leer tarea
    public function leerUno($id)
    {
        $query = "SELECT titulo, descripcion FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row;
        }
        return null;
    }

    //Actualizar tarea
    public function actualizar($id, $titulo, $descripcion)
    {
        $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, descripcion = :descripcion WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    //Borrar tarea
    public function borrar($id)
    {
        $query = "UPDATE " . $this->table_name . " SET estado = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>
