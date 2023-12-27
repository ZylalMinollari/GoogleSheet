<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class ImportHelper
{

    public static function importData()
    {
        try {
            // DB::beginTransaction();

            $createdTables = 0;
            $addedColumns = 0;
            $updatedRecords = 0;
            $data = Config::get('google_sheets_data');

            foreach ($data as $fileName => $sheets) {
                foreach ($sheets as $sheetName => $sheetData) {
                    $tableName = $sheetName;

                    if (!Schema::hasTable($tableName)) {
                        self::createTable($tableName, $sheetData);
                        $createdTables++;
                    } else {
                        self::updateTableColumns($tableName, $sheetData);
                        $addedColumns++;
                    }

                    $rows = self::getDataFromGoogleSheet($fileName, $sheetName);
                    $existingRecords = DB::table($tableName)->get();

                    $rows = self::getDataFromGoogleSheet($fileName, $sheetName);
                    $existingRecords = DB::table($tableName)->get();

                    foreach ($sheetData['row'] as $index => $rowId) {
                        $rowData = [
                            'id' => $rowId,
                        ];

                        foreach ($sheetData as $columnName => $columnValues) {
                            $value = $columnValues[$index] ?? null;

                            if (Schema::getColumnType($tableName, $columnName) == 'string' && $value === '') {
                                $value = null;
                            }

                            $rowData[$columnName] = $value;
                        }

                        $existingRecord = $existingRecords->firstWhere('id', $rowData['id']);

                        if ($existingRecord) {
                            DB::table($tableName)->where('id', $existingRecord->id)->update($rowData);
                            $updatedRecords++;
                        } else {
                            DB::table($tableName)->insert($rowData);
                        }
                    }

                    Log::info("Data from $sheetName in $fileName imported to $tableName table.");
                }
            }

            //DB::commit();

            Log::info("$createdTables new tables created.");
            Log::info("$addedColumns columns added to existing tables.");
            Log::info("$updatedRecords records updated.");

            return true;
        } catch (\Exception $e) {
            //DB::rollBack();
            Log::info('Data import failed: ' . $e->getMessage());
            return false;
        }
    }

    private static function getDataFromGoogleSheet($fileName, $sheetName)
    {

        $googleSheetData = Config::get('google_sheets_data');
        $sheetData = $googleSheetData[$fileName][$sheetName];
        return [$sheetData];
    }

    private static function createTable($tableName, $sheetData)
    {

        Schema::create($tableName, function ($table) use ($sheetData) {
            $table->id();
            foreach ($sheetData as $columnName => $columnType) {
                $table->string($columnName);
            }
            $table->timestamps();
        });
    }

    private static function updateTableColumns($tableName, $sheetData)
    {
        $existingColumns = Schema::getColumnListing($tableName);

        foreach ($sheetData as $columnName => $columnType) {
            if (!in_array($columnName, $existingColumns)) {
                Schema::table($tableName, function ($table) use ($columnName) {
                    $table->string($columnName);
                });
            }
        }
    }
}
