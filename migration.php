<?php
require __DIR__ . "/config/env.php";

$host = env('DB_HOST','localhost');
$user = env('DB_USERNAME','root');
$pass = env('DB_PASSWORD','');
$dbName = env('DB_DATABASE','');
$charset = 'utf8mb4';
$migrationDir = __DIR__ . '/migration';
$initialSqlFile = "$migrationDir/database.sql";

function connectPDO($host, $user, $pass, $dbname = null, $charset = 'utf8mb4') {
    $dsn = "mysql:host=$host" . ($dbname ? ";dbname=$dbname" : "") . ";charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

try {
    // Connect without selecting database
    $pdo = connectPDO($host, $user, $pass);


        if (file_exists($initialSqlFile)) {
            $sql = file_get_contents($initialSqlFile);
            $pdo->exec($sql);
            echo "Database '$dbName' created successfully." . PHP_EOL;
        } else {
            throw new Exception("Initial SQL file not found: $initialSqlFile");
        }


    // Connect to the actual database
    $pdo = connectPDO($host, $user, $pass, $dbName);

    // Process migration files
    if (!is_dir($migrationDir)) {
        throw new Exception("Migration directory does not exist: $migrationDir");
    }

    $files = array_diff(scandir($migrationDir), ['.', '..', 'database.sql']);

    $filesWithTime = [];

    foreach ($files as $file) {
        $filePath = $migrationDir . DIRECTORY_SEPARATOR . $file;
        if (is_file($filePath)) {
            $filesWithTime[$file] = filemtime($filePath);
        }
    }

    asort($filesWithTime);

    $sortedFiles = array_keys($filesWithTime);


    foreach ($sortedFiles as $file) {
        $filePath = $migrationDir . DIRECTORY_SEPARATOR . $file;

        if (!is_file($filePath)) continue;

        $checkMigration = $pdo->prepare("SELECT 1 FROM migration WHERE name = ?");
        $checkMigration->execute([$file]);

        if ($checkMigration->rowCount() === 0) {
            $sql = file_get_contents($filePath);
            $pdo->exec($sql);

            $logMigration = $pdo->prepare("INSERT INTO migration (name) VALUES (?)");
            $logMigration->execute([$file]);

            echo "Migration applied:" .  $file   .PHP_EOL;
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
