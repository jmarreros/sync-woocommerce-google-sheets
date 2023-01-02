<?php

require __DIR__ . '/vendor/autoload.php';

function get_google_sheet_data(){
	try {
		// Configure custom values
		$path = __DIR__ . '/auth/credentials.json';
		$spreadsheetId = '1jKQA0szu3w1XTYArIddlpYhAREOMzSBFyZouY39tIoc';
		$range = 'Hoja 1';

		// configure the Google Client
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');

		$client->setAuthConfig($path);

		// configure the Sheets Service
		$service = new \Google_Service_Sheets($client);

		// get all the rows of a sheet
		$response = $service->spreadsheets_values->get($spreadsheetId, $range);
	} catch (Exception $e){
		return $e->getMessage();
	}

    return $response->getValues();
}

