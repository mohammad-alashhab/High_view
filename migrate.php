<?php

require_once 'core/Dbconn.php';
$conn = new conn();
$pdo = $conn->connect();

$executedMigrations = $pdo->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_COLUMN);
$migrationFiles = scandir(__DIR__ . "/migrations");
$batch = (int) $pdo->query("SELECT MAX(batch) FROM migrations")->fetchColumn() + 1;

foreach ($migrationFiles as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    $className = convertToClassName($file);
    echo "Processing file: $file | Expected class name: $className\n";

    require_once(__DIR__ . "/migrations/" . $file);

    if (class_exists($className)) {
        echo "Class $className successfully loaded from file: $file\n";
    } else {
        echo "Class $className not found after including the file: $file\n";
        continue;
    }

    if (!in_array($className, $executedMigrations)) {
        try {
            $migration = new $className();
            $pdo->exec($migration->up());

            $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (:migration, :batch)");
            $stmt->execute(['migration' => $className, 'batch' => $batch]);

            echo "Migration $className has been executed.\n";
        } catch (PDOException $e) {
            echo "Failed to execute migration $className: " . $e->getMessage() . "\n";
        }
    }
}

function convertToClassName($file) {
    $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
    $fileNameWithoutDate = preg_replace('/^(\d{4}_\d{2}_\d{2}_)/', '', $fileNameWithoutExtension);
    $parts = explode('_', $fileNameWithoutDate);
    $className = "";

    foreach ($parts as $part) {
        $className .= ucfirst($part);
    }

    return $className;
}
