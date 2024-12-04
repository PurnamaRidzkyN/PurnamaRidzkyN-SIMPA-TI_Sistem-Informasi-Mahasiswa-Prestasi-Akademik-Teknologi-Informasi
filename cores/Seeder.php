<?php

namespace app\cores;

class Seeder
{
    private Database $db;

    public function __construct(array $config)
    {
        $this->db = new Database($config);
    }

    public function create(): void
    {
        $seederPath = realpath(__DIR__ . "/../models/seeders");
        $files = scandir($seederPath);

        foreach ($files as $file) {
            if ($file === "." || $file === "..") {
                continue;
            }

            require_once $seederPath . "/" . $file;
            $className = pathinfo($file, PATHINFO_FILENAME);
            $seeder = new $className();

            echo "inserting table " . $className . "\n";
            $query = $seeder->create();

            if (isset($query["errors"])) {
                echo "failed to insert table " . $className . "\n";
                $errMessages = $query["errors"];

                foreach ($errMessages as $errMessage) {
                    echo $errMessage . "\n";
                }

                echo "\n";
                return;
            } else {
                echo "table {$className} inserted.\n";
            }
        }
    }


    public function delete(): void
    {
        $seederPath = realpath(__DIR__ . "/../models/seeders");
        $files = scandir($seederPath);

        foreach ($files as $file) {
            if ($file === "." || $file === "..") {
                continue;
            }

            require_once $seederPath . "/" . $file;
            $className = pathinfo($file, PATHINFO_FILENAME);
            $seeder = new $className();

            echo "deleting columns " . $className . "\n";
            $query = $seeder->delete();

            if (isset($query["errors"])) {
                echo "failed to delete columns " . $className . "\n";
                $errMessages = $query["errors"];

                foreach ($errMessages as $errMessage) {
                    echo $errMessage . "\n";
                }

                echo "\n";
                return;
            } else {
                echo "columns {$className} deleted.\n";
            }
        }
    }
}