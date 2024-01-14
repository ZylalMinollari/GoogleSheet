# # Daily Google Sheets Command Documentation

## Overview

The `DailyGoogleSheets` command is a Laravel console command designed to run daily for importing data from Google Sheets to the application's database. The process involves fetching data from Google Sheets API, formatting it, and then importing it into the application's database.

## Tasks Performed

The `DailyGoogleSheets` class  is responsible for two main tasks:

1. **Importing Data from Google Sheets:**
   - Utilizes the `GoogleSheetHelper` to fetch data from designated Google Sheets.
   - This step involves interacting with the Google Sheets API to obtain the necessary data.

2. **Importing Data into the Application's Database:**
   - Employs the `ImportHelper` to process the data obtained from Google Sheets.
   - The data is formatted and imported into the application's database for immediate accessibility.

The `handle` in `DailyGoogleSheets.php` method is responsible for executing the command. It follows the following steps:

Calls the GoogleSheetHelper::importData() method to import data from Google Sheets.
If the Google Sheets import is successful, it prints a success message and proceeds to the next step. Otherwise, it prints an error message and terminates.
Calls the ImportHelper::importData() method to import the data into the application's database.
If the database import is successful, it prints a success message. Otherwise, it prints an error message.

### GoogleSheetHelper

The `GoogleSheetHelper` class provides methods for interacting with the Google Sheets API and importing data into the application.

#### Methods

1. **importData()**
    - Fetches data from Google Sheets API.
    - Formats the data and stores it in the `config/google_sheet_data.php` file.
    - Returns `true` on success.

2. **getFileAndSheetDataFromAPI()**    
    - Retrieves file and sheet data from the Google Sheets API endpoint.
    - Returns an array containing file and sheet information.

3. **getSheetData($client, $spreadsheetId, $sheetName)**
    - Retrieves data from a specific sheet within a spreadsheet.
    - Returns an array of sheet data.

4. **getClient()**
    - Sets up the Google API client.
    - Handles authentication and access token storage.
    - Returns the configured Google API client. 

### ImportHelper

The `ImportHelper` class manages the import process of Google Sheets data into the application's database.

#### Methods

1. **importData()**
   - Imports data from Google Sheets into the database.
   - Dynamically creates tables or updates existing ones based on the provided data.
   - Returns `true` on success.

2. **getDataFromGoogleSheet($fileName, $sheetName)**
   - Retrieves data from Google Sheets based on the given file and sheet names.
   - Returns an array of sheet data.

3. **createTable($tableName, $sheetData)**
   - Creates a new table in the database with columns based on the provided sheet data.

4. **updateTableColumns($tableName, $sheetData)**
   - Adds new columns to an existing table based on the provided sheet data

Instruction on how to create Goolge API tokens are found in this file [Link to Google.md](Google.md)

For building this project I have used Windows and a local server called laragon.It is same with xampp.
But a way how to set up this in liunx I have provided in [Link to run.sh](run.sh).

About a structure of database I have decided that a table or a column will be created when the sript runs if it is not found. For this only need to crrate a database that the name should be as it is in .env.exampe file.

A point that is not completed is about 
5.	For example, if a file has data in columns [date, product_name, price, amount], the configuration table should specify that this data should be stored in the 'sales' table with columns [date=>date, product_name=>name, price=>product_price, amount=>amount]. The names of columns in the file and the database table can be different, and the configuration table should allow data from one file to be saved to multiple tables with different structures. I have decided that the name of column in database will be the same as the column of sheet.
## Usage

Run the command using the following Artisan command:

```bash
php artisan daily:google-sheet


