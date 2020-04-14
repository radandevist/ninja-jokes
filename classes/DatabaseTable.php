<?php
class DatabaseTable
{
    private function query($pdo, $sql, $parameters = [])
    {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    private function processDates($fields)
    {
        foreach ($fields as $key => $value){
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function totalCount($pdo, $table)
    {
        $sql = "SELECT COUNT(*) FROM `" . $table . "`";
        $query = $this->query($pdo, $sql);
        $row = $query->fetch();
        return $row[0];
    }

    public function getAll($pdo, $table)
    {
        $sql = "SELECT * FROM `" . $table ."`";
        $query = $this->query($pdo, $sql);
        return $query->fetchAll();
    }

    public function getById($pdo, $table, $primaryKey, $pkValue)
    {
        $sql = "SELECT * FROM `" . $table . "`WHERE `" . $primaryKey . "` = :pkValue";
        $parameters = [
            'pkValue' => $pkValue
        ];
        $query = $this->query($pdo, $sql, $parameters);
        return $query->fetch();
    }

    private function insert($pdo, $table, $fields)
    {
        $sql = "INSERT INTO `" . $table . "` (";
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
        $this->query($pdo, $sql, $fields);
    }

    private function update($pdo, $table, $fields, $primaryKey)
    {
        $sql = "UPDATE `" . $table . "` SET ";
        foreach ($fields as $key => $value) {
        $sql .= '`' . $key . '` = :' . $key . ',';
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE `" . $primaryKey . "` = :primaryKey";
        $fields['primaryKey'] = $fields['id'];
        $fields = $this->processDates($fields);
        $this->query($pdo, $sql, $fields);
    }

    public function save($pdo, $table,  $fields, $primaryKey)
    {
        try {
            if ($fields[$primaryKey] == '') {
                $fields[$primaryKey] = null;
            }
            $this->insert($pdo, $table, $fields);
        }
        catch (PDOException $e) {
            $this->update($pdo, $table, $fields, $primaryKey);
        }
    }

    public function delete($pdo, $table, $primaryKey, $pkValue)
    {
        $sql = "DELETE FROM `" . $table . "` WHERE " . $primaryKey . " = :id";
        $parameters = ['id' => $pkValue];
        $this->query($pdo, $sql, $parameters);
    }

}