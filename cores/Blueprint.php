<?php

namespace app\cores;

use app\constant\Config;

class Blueprint
{
    private string $tableName;
    private array $columns = [];
    private array $constraints = [];
    private array $alterations = [];
    private array $insertions = [];
    private array $selections = [];


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
        $this->columns[] = "[$column] datetime DEFAULT CURRENT_TIMESTAMP";
    }
    public function text(string $column): void
    {
        $this->columns[] = "[$column] text";
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


    public function insert(array $columns, array $values): void
    {
        $placeholders = array_map(fn($col) => ":$col", $columns);
        $columnsSql = implode(", ", $columns);
        $placeholdersSql = implode(", ", $placeholders);


        $this->insertions[] = [
            "query" => "INSERT INTO [$this->tableName] ($columnsSql) VALUES ($placeholdersSql)",
            "params" => array_combine($placeholders, $values)
        ];
    }


    public function getInsertions(): array
    {
        return $this->insertions;
    }

    public function update(string $columnSql, string $value, string $columnWhere, string $where): void
    {
        $query = "UPDATE [$this->tableName] SET $columnSql = '$value' WHERE $columnWhere = '$where';";

        $this->alterations = ["query" => $query];
    }

    public function select(array|string $columns = "*"): void
    {
        $columnsSql = is_array($columns) ? implode(", ", $columns) : $columns;

        $query = "SELECT $columnsSql FROM [$this->tableName]";
        $this->selections = ["query" => $query];
    }


    public function selectWhere(array|string $conditions, array|string $columns = "*"): void
    {
        $columnsTsql = is_array($columns) ? implode(",", $columns) : $columns;
        $whereClauses = [];
        $params = [];

        foreach ($conditions as $column => $value) {
            $paramKey = ":$column";
            $whereClauses[] = "$column = $paramKey";
            $params[$paramKey] = $value;
        }

        $whereTsql = implode(" AND ", $whereClauses);
        $this->selections = [
            "query" => "SELECT $columnsTsql FROM [$this->tableName] WHERE $whereTsql;",
            "params" => $params
        ];
    }

    public function getSelection(): array
    {
        return $this->selections;
    }

    public function execute($query, $params = null): array
    {
        $prepare = $this->db::getConnection()->prepare($query);
        $execute = $prepare->execute($params);

        if (!$execute) {
            return [
                "errors" => $prepare->errorInfo(),
            ];
        }

        // Check if the query is a SELECT or similar query
        if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|EXPLAIN)/i', $query)) {
            return [
                "result" => $prepare->fetchAll(\PDO::FETCH_ASSOC) ?: null,
                "errors" => null
            ];
        }

        // For non-select queries, return success
        return [
            "result" => null,
            "errors" => null
        ];
    }
}
