<?php
namespace NinjaFramework;

// use DateTime,
    // PDO,
    // PDOException;

class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct(\PDO $pdo, string $table, string $primaryKey)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    private function query($sql, $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    private function processDates($fields)
    {
        foreach ($fields as $key => $value){
            if ($value instanceof \DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function totalCount()
    {
        $sql = "SELECT COUNT(*) FROM `" . $this->table . "`";
        $query = $this->query($sql);
        $row = $query->fetch();
        return $row[0];
    }

    public function getAll()
    {
        $sql = "SELECT * FROM `" . $this->table ."`";
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function getById($pkValue)
    {
        $sql = "SELECT * FROM `" . $this->table . "`WHERE `" . $this->primaryKey . "` = :pkValue";
        $parameters = [
            'pkValue' => $pkValue
        ];
        $query = $this->query($sql, $parameters);
        return $query->fetch();
    }

    private function insert($fields)
    {
        $sql = "INSERT INTO `" . $this->table . "` (";
        foreach ($fields as $key => $values) {
            $sql .= '`'. $key . '`,';
        }
        $sql = rtrim($sql, ',');
        $sql .= ') VALUES (';
        foreach ($fields as $key => $value) {
            $sql .= ':' . $key . ',';
        }
        $sql = rtrim($sql, ',');
        $sql .= ')';
        $fields = $this->processDates($fields);
        $this->query($sql, $fields);
    }

    private function update($fields)
    {
        $sql = "UPDATE `" . $this->table . "` SET ";
        foreach ($fields as $key => $value) {
            $sql .= '`' . $key . '` = :' . $key . ',';
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE `" . $this->primaryKey . "` = :primaryKey";
        $fields['primaryKey'] = $fields['id'];
        $fields = $this->processDates($fields);
        $this->query($sql, $fields);
    }

    public function save($fields)
    {
        try {
            if ($fields[$this->primaryKey] == '') {
                $fields[$this->primaryKey] = null;
            }
            $this->insert($fields);
        }
        catch (\PDOException $e) {
            $this->update($fields);
        }
    }

    public function delete($pkValue)
    {
        $sql = "DELETE FROM `" . $this->table . "` WHERE " . $this->primaryKey . " = :id";
        $parameters = ['id' => $pkValue];
        $this->query($sql, $parameters);
    }

}