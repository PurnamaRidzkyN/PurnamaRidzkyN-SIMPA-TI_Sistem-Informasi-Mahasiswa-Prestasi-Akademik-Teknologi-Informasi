<?php

namespace app\cores;

require_once "vendor/autoload.php";
require_once "helpers/env.php";

class Migration
{
    private Database $database;

    public function __construct(array $config)
    {
        $this->database = new Database($config);
    }

    public function migrate(): void
    {
        $migrationPath = realpath(__DIR__ . '/../models/migrations');
        $files = scandir($migrationPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            require_once $migrationPath . "/" . $file;
            $className = pathinfo($file, PATHINFO_FILENAME);
            $migration = new $className();

            echo "applying migration $file\n";
            $query = $migration->up();

            if (isset($query["errors"])) {
                echo "failed to apply migration $file\n";
                $errMessage = $query["errors"];

                foreach ($errMessage as $message) {
                    echo $message["message"] . "\n";
                }

                echo "\n";
                return;
            } else {
                echo "applied migration $file\n";
            }
        }
    }

    public function rollback(): void
    {
        $migrationPath = realpath(__DIR__ . '/../models/migrations');
        $files = scandir($migrationPath);
        rsort($files);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            require_once $migrationPath . "/" . $file;
            $className = pathinfo($file, PATHINFO_FILENAME);
            $migration = new $className();

            echo "rollback migration $file\n";
            $query = $migration->down();
            
            if (isset($query["errors"])) {
                echo "failed to rollback migration $file\n";
                $errMessage = $query["errors"];

                foreach ($errMessage as $message) {
                    echo $message["message"] . "\n";
                }

                echo "\n";
                return;
            } else {
                echo "rolled back migration $file\n";
            }
        }
    }
}