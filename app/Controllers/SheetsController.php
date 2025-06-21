<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SheetsController extends BaseController
{
    public function index()
{
    try {
        $spreadsheetId = 'YOUR_SPREADSHEET_ID'; // Put your real Google Sheet ID here
        $url = "https://spreadsheets.google.com/feeds/list/$spreadsheetId/od6/public/values?alt=json";

        $json = @file_get_contents($url);

        if ($json === false) {
            $error = error_get_last();
            throw new \Exception('Failed to fetch URL: ' . ($error['message'] ?? 'Unknown error'));
        }

        $data = json_decode($json, true);
        if ($data === null) {
            throw new \Exception('Failed to decode JSON. JSON error: ' . json_last_error_msg());
        }

        $rows = [];
        foreach ($data['feed']['entry'] as $entry) {
            $row = [];
            foreach ($entry as $key => $value) {
                if (strpos($key, 'gsx$') === 0) {
                    $colName = substr($key, 4);
                    $row[$colName] = $value['$t'];
                }
            }
            $rows[] = $row;
        }

        return $this->response->setJSON($rows);

    } catch (\Exception $e) {
        // Return the error message in response for debugging
        return $this->response
            ->setStatusCode(500)
            ->setBody('Error: ' . $e->getMessage());
    }
}


    
}
