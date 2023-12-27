<?php

namespace App\Console\Commands;

use App\Helpers\ImportHelper;
use Illuminate\Console\Command;
use App\Helpers\GoogleSheetHelper;

class DailyGoogleSheets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:google-sheets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command runs daily for Google Sheets';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        try {
           $importGoogleSheet = GoogleSheetHelper::importData();

            if ($importGoogleSheet) {
                $this->info('Google Sheets data import completed.');


                $importDatabase = ImportHelper::importData();

                if ($importDatabase) {
                    $this->info('Database import completed.');
                } else {
                    $this->error('Database import failed.');
                }
           } else {
               $this->error('Google Sheets data import failed.');
           }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
