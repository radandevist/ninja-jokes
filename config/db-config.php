<?php
    function checkEnv(string $env, string $altValue)
    {
        return (!empty(getenv($env))) ? getenv($env) : $altValue;
    }

    $db_ms = 'mysql';
    $db_host = checkEnv('DB_HOST', 'localhost');
    $db_name = checkEnv('DB_NAME', 'phpninja');
    $db_user = checkEnv('DB_USER', 'ninjaphp');
    $db_password = checkEnv('DB_PASSWORD', 'ninjapass#2020');
?>