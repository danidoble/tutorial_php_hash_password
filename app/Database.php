<?php

namespace App;

use PDO;

class Database{
    public string $user = 'root';
    public string $pass = '';
    public string $host = '127.0.0.1';
    public string $db = 'pruebas';
    protected ?PDO $conn = null;
    // conexion a la base de datos con PDO

    public function connect(): static
    {
        $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this;
    }

    // insertar datos en la base de datos
    public function insert(string $table, array $data): static
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($data));
        return $this;
    }

    // obtener datos de la base de datos
    public function get(string $table, array $data): mixed
    {
        $sql = "SELECT * FROM $table WHERE $data[0] = $data[1]";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // actualizar datos de la base de datos con una sentencia preparada para cada campo del array dado y un tercer parametro para el where como array
    public function update(string $table, array $data, array $where): static
    {
        $sql = "UPDATE $table SET ";
        $sql .= implode(' = ?, ', array_keys($data));
        $sql .= ' = ? WHERE ';
        $sql .= implode(' = ? AND ', array_keys($where));
        $sql .= ' = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_merge(array_values($data), array_values($where)));
        return $this;
    }

    // eliminar datos de la base de datos
    public function delete(string $table, array $data): int|false
    {
        $sql = "DELETE FROM $table WHERE $data[0] = $data[1]";
        return $this->conn->exec($sql);
    }

    // cerrar conexion a la base de datos
    public function close(): static
    {
        $this->conn = null;
        return $this;
    }

}