<?php

return [
    "host" => "localhost",
    "dbname" => "phpPracticeDb",
    "dbusername" => "root",
    "dbpassword" => "",
    "charset" => "utf8mb4",
    "options" => [
        // additional parameter for default like assoc array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // і так йде за
        // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];