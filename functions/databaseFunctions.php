<?php

// ===========================
function query($pdo, $sql, $parameters = [])
{
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function processDates($fields)
{
    foreach ($fields as $key => $value){
        if ($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d');
        }
    }
    return $fields;
}


// =========================
function findAll($pdo, $table)
{
    $sql = "SELECT * FROM `" . $table ."`";
    $query = query($pdo, $sql);
    return $query->fetchAll();
}

function delete($pdo, $table, $primaryKey, $pkValue)
{
    $sql = "DELETE FROM `" . $table . "` WHERE " . $primaryKey . " = :id";
    $parameters = ['id' => $pkValue];
    query($pdo, $sql, $parameters);
}

function insert($pdo, $table, $fields)
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
    $fields = processDates($fields);
    query($pdo, $sql, $fields);
}

function update($pdo, $table, $fields, $primaryKey)
{
    $sql = "UPDATE `" . $table . "` SET ";
    foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '` = :' . $key . ',';
    }
    $sql = rtrim($sql, ',');
    $sql .= " WHERE `" . $primaryKey . "` = :primaryKey";
    $fields['primaryKey'] = $fields['id'];
    $fields = processDates($fields);
    query($pdo, $sql, $fields);
}

function findById($pdo, $table, $primaryKey, $pkValue)
{
    $sql = "SELECT * FROM `" . $table . "`WHERE `" . $primaryKey . "` = :pkValue";
    $parameters = [
        'pkValue' => $pkValue
    ];
    $query = query($pdo, $sql, $parameters);
    return $query->fetch();
}

function total($pdo, $table)
{
    $sql = "SELECT COUNT(*) FROM `" . $table . "`";
    $query = query($pdo, $sql);
    $row = $query->fetch();
    return $row[0];
}

function save($pdo, $table,  $fields, $primaryKey)
{
    try {
        if ($fields[$primaryKey] == '') {
            $fields[$primaryKey] = null;
        }
        insert($pdo, $table, $fields);
    }
    catch (PDOException $e) {
        update($pdo, $table, $fields, $primaryKey);
    }
}

?>