<?php

namespace app\cores;

use app\constant\Config;

class Blueprint
{
    private string $tableName;
    private array $columns = [];
    private array $constraints = [];
    private array $alterations = [];

    private Database $db;

    public function __construct(string $tableName = "")
    {
        $this->tableName = $tableName;
        $this->db = new Database(Config::getConfig());
    }

    public function string(string $column, int $length = 255): void
    {
        $this->columns[] = "[$column] nvarchar($length)";
    }

    public function int(string $column): void
    {
        $this->columns[] = "[$column] int";
    }

    public function tinyInt(string $column): void
    {
        $this->columns[] = "[$column] tinyint";
    }

    public function date(string $column): void
    {
        $this->columns[] = "[$column] date";
    }

    public function datetime(string $column): void
    {
        $this->columns[] = "[$column] datetime";
    }
    public function text(string $column): void
    {
        $this->columns[] = "[$column] text";
    }
    public function bool(string $column): void
    {
        $this->columns[] = "[$column] Bit";
    }

    
    public function check(string $column, array $values): void
    {
        $valueList = implode(", ", $values);
        $this->constraints[] = "CHECK ([$column] IN ($valueList))";
    }


    public function unique($column): void
    {
        $this->constraints[] = "UNIQUE([$column])";
    }

    public function primary(string $column): void
    {
        $this->constraints[] = "PRIMARY KEY([$column])";
    }

    public function foreign(string $column, string $referencesTable, string $referencesColumn): void
    {
        $this->constraints[] = "FOREIGN KEY([$column]) REFERENCES $referencesTable ([$referencesColumn]) ON DELETE CASCADE";
    }

    public function alterAddForeignKey(
        string $columnName,
        string $referenceTable,
        string $referenceColumn,
        string $constraintName,
        string $onDelete = "NO ACTION",
        string $onUpdate = "NO ACTION"
    ): void {

        $this->alterations[] = "ALTER TABLE [$this->tableName]
                ADD CONSTRAINT [$constraintName] FOREIGN KEY ([$columnName]) 
                REFERENCES [$referenceTable] ([$referenceColumn]) 
                ON DELETE $onDelete ON UPDATE $onUpdate;";
    }

    public function alterDropConstraint(string $constraintColumn): void
    {
        $this->alterations[] = "ALTER TABLE [$this->tableName] DROP CONSTRAINT [$constraintColumn]";
    }


    public function getAlterations(): array
    {
        return $this->alterations;
    }

    public function getColumnsAndConstraints(): array
    {
        $columnSql = implode(", ", $this->columns);
        $constraintSql = implode(", ", $this->constraints);

        return [
            "columns" => $columnSql,
            "constraints" => $constraintSql
        ];
    }


    public function execute($query): array
    {
        $execute = $this->db::getConnection()->prepare($query)->execute();

        if (!$execute) {
            return [
                "errors" => $this->db::getConnection()->errorInfo(),
            ];
        }

        return [
            "errors" => null
        ];
    }
}
