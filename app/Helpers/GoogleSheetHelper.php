<?php

namespace App\Helpers;

use Google_Client;
use Google_Service_Sheets;
use Revolution\Google\Sheets\Facades\Google;

class GoogleSheetHelper
{
    public static function importData()
    {
        try {
            $filesAndSheets = self::getFileAndSheetDataFromAPI();

            $client = self::getClient();

            $formattedData = [];

            foreach ($filesAndSheets as $fileId => $sheets) {
                $formattedData[$fileId] = [];

                foreach ($sheets as $sheetName) {
                    $sheetData = self::getSheetData($client, $fileId, $sheetName);

                    $formattedData[$fileId][$sheetName] = [
                        'row_number' => range(1, count($sheetData)),
                    ];

                    foreach ($sheetData as $row) {
                        foreach ($row as $index => $value) {
                            $columnName = 'column' . ($index + 1);
                            $formattedData[$fileId][$sheetName][$columnName][] = $value;
                        }
                    }
                }
            }

            $phpCode = '<?php return ' . var_export($formattedData, true) . ';';
            file_put_contents('config/google_sheet_data.php', $phpCode);

            return true;
        } catch (\Exception $e) {

            throw $e;
        }
    }

    private static function getFileAndSheetDataFromAPI()
    {

        $apiEndpoint = 'https://www.googleapis.com/robot/v1/metadata/x509/google-sheet-api-733%40alien-vim-409222.iam.gserviceaccount.com';
        
        $ch = curl_init($apiEndpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Error fetching data from API: ' . curl_error($ch));
        }

        curl_close($ch);

        $data = json_decode($apiResponse, true);

        if ($data) {
            return $data;
        } else {

            throw new \Exception('Error decoding data from API');
        }
    }

    private static function getSheetData($client, $spreadsheetId, $sheetName)
    {
        $service = new Google_Service_Sheets($client);

        $range = $sheetName;

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        return $values;
    }

    private static function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig('path/to/your/credentials.json');
        $client->setAccessType('offline');

        $tokenPath =  storage_path('alien-vim-409222-207a5532e310.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        } else {
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            file_put_contents($tokenPath, json_encode($accessToken));
            printf("Token stored to %s\n", $tokenPath);
        }

        return $client;
    }
}
