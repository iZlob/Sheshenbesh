<?php

namespace Classes;

use \SQLite3;
use \SQLite3Result;

class DataBaseProvider
{
    private SQLite3 $database;

    public function __construct()
    {
        $databaseFile = "db.sqlite";

        if (!file_exists($databaseFile)) {
            $this->CreateEmptyDatabaseFile($databaseFile);
            $this->database = new SQLite3("db.sqlite", SQLITE3_OPEN_READWRITE);
            $this->CreateWhiteChipsTable();
            $this->CreateBlackChipsTable();
            $this->database->close();
        }

        $this->database = new SQLite3("db.sqlite", SQLITE3_OPEN_READWRITE);
    }
    private function CreateEmptyDatabaseFile(string $databaseFile): void{
        $file = fopen($databaseFile, "w");
        fclose($file);
    }
    private function CreateWhiteChipsTable(): void{
        $sqlCommand = <<<SQL
            CREATE TABLE WhiteChips(
                ID INTEGER PRIMARY KEY AUTOINCREMENT,
                ChipPlace INTEGER
            )
        SQL;

        $this->database->exec($sqlCommand);
    }

    private function CreateBlackChipsTable(): void{
        $sqlCommand = <<<SQL
            CREATE TABLE BlackChips(
                ID INTEGER PRIMARY KEY AUTOINCREMENT,
                ChipPlace INTEGER
            )
        SQL;

        $this->database->exec($sqlCommand);
    }

    public function AddWhiteChipToBoard(int $chipPlaceIndex): void {
        $sqlCommand = <<<SQL
            INSERT INTO WhiteChips(ChipPlace)
            VALUES ($chipPlaceIndex)
        SQL;

        $this->database->exec($sqlCommand);
    }

    public function AddBlackChipToBoard(int $chipPlaceIndex): void {
        $sqlCommand = <<<SQL
            INSERT INTO BlackChips(ChipPlace)
            VALUES ($chipPlaceIndex)
        SQL;

        $this->database->exec($sqlCommand);
    }

    public function GetWhiteChipsOnBoard(): array {
        $sqlCommand = <<<SQL
            SELECT ChipPlace AS "Index"
            FROM WhiteChips
        SQL;

        $result = $this->database->query($sqlCommand);

        return $this->CreateChipIndexesArray($result, "Index");
    }

    public function GetBlackChipsOnBoard(): array {
        $sqlCommand = <<<SQL
            SELECT ChipPlace AS "Index"
            FROM BlackChips
        SQL;

        $result = $this->database->query($sqlCommand);

        return $this->CreateChipIndexesArray($result, "Index");
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->database -> close();
    }

    /**
     * @param false|SQLite3Result $result
     * @param string $columnName
     * @return array
     */
    public function CreateChipIndexesArray(false|SQLite3Result $result, string $columnName): array
    {
        if(!$result){
            return [];
        }

       $indexArray = [];

        while (true) {
            $rowArray = $result->fetchArray(SQLITE3_BOTH);

            if (is_array($rowArray)) {
                $indexArray[] = $rowArray[$columnName];
            } else {
                break;
            }
        }

        return $indexArray;
        //return[];
    }
}