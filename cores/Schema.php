<?php

namespace app\cores;

class Schema
{
    public static function createTableIfNotExist(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $query = $blueprint->getColumnsAndConstraints();
        $column = $query["columns"];
        $constraint = $query["constraints"];

        $tsql = "IF NOT EXISTS (
                SELECT *
                FROM sysobjects
                WHERE name = '$tableName' AND xtype = 'U'
            )
            BEGIN
                CREATE TABLE [$tableName] ($column
           ";

        if (!empty($constraint)) {
            $tsql .= ", $constraint";
        }

        $tsql .= ") END;";

        return $blueprint->execute($tsql);
    }
    public static function createTriggerIfNotExist(string $tableName, string $triggerName, string $trigerLogic, string $event): array
    {
        $tsql = "
        IF NOT EXISTS (
            SELECT * 
            FROM sysobjects
            WHERE name = '$triggerName'
        )
        BEGIN
         EXEC('
            CREATE TRIGGER [$triggerName]
            ON [$tableName]
            AFTER $event
            AS
            BEGIN
                $trigerLogic
        END');
    END;";
        $blueprint = new Blueprint($tsql);
        return $blueprint->execute($tsql);
    }
    public static function dropTriggerIfExist(string $triggerName): array
    {
        $blueprint = new Blueprint($triggerName);
        $tsql = "DROP TRIGGER IF EXISTS [$triggerName];";
        return $blueprint->execute($tsql);
    }

    public static function update(string $tableName, callable $callback)
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $update = $blueprint->getAlterations();
        return $blueprint->execute($update["query"]);
    }
    public static function insertInto(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $insertions = $blueprint->getInsertions();

        $results = [];

        foreach ($insertions as $insertion) {
            $results[] = $blueprint->execute($insertion["query"], $insertion["params"]);
        }

        return $results;
    }

    public static function dropTableIfExist(string $tableName): array
    {
        $blueprint = new Blueprint($tableName);
        $tsql = "DROP TABLE IF EXISTS [$tableName];";
        return $blueprint->execute($tsql);
    }

    public static function alterTable(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $tsql = $blueprint->getAlterations();

        foreach ($tsql as $query) {
            return $blueprint->execute($query);
        }

        return [];
    }

    public static function deleteFrom(string $tableName): array
    {
        $blueprint = new Blueprint($tableName);
        $tsql = "DELETE FROM [$tableName];";
        return $blueprint->execute($tsql);
    }

    public static function selectFrom(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $selections = $blueprint->getSelection();

        return $blueprint->execute($selections["query"]);
    }

    public static function selectWhereFrom(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $selections = $blueprint->getSelection();
        return $blueprint->execute($selections["query"], $selections["params"]);
    }

    public static function query(string $query): array
    {
        $blueprint = new Blueprint($query);
        return $blueprint->execute($query);
    }
}
