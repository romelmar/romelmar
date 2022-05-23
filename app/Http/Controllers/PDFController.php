<?php

namespace App\Http\Controllers;

use mikehaertl\pdftk\Pdf;
use Illuminate\Support\Facades\Log;


class PDFController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function downloadPDF()
    {
        $filePath = public_path('images/test-encrypt.pdf');
        Log::info($filePath);

        $pdf = new Pdf($filePath,
                [
                    'command' => 'C:\Program Files (x86)\PDFtk\bin\pdftk.exe',
                    'useExec' => true,  // May help on Windows systems if execution fails
                ]);

        $password = '123456';
        $userPassword = '123456b';

        $result = $pdf
            ->allow('AllFeatures')      
            ->setPassword($password)
            ->setUserPassword($userPassword)
            ->passwordEncryption(128)
            ->saveAs($filePath);

    }
}
