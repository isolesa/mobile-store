<?php

function insertExcel($urls,$visits){

    $excelApp = new COM("Excel.Application");
    $excelApp -> Visible = true;

    $excelFile = $excelApp -> Workbooks -> Open(ABSOLUTE_PATH."/data/excel/urls.xls");

    $worksheet = $excelFile -> Worksheets("urls");
    $worksheet -> activate;

    for($i = 1; $i <= count($urls); $i++){

        $acell = $worksheet -> Range("A".$i);
        $acell -> activate;
        $acell -> Value = $i;

        $bcell = $worksheet -> Range("B".$i);
        $bcell -> activate;
        $bcell -> Value = $urls[$i - 1];

        $ccell = $worksheet -> Range("C".$i);
        $ccell -> activate;
        $ccell -> Value = $visits[$i - 1];
    }

    $excelFile -> Save();

    unset($worksheet);
    unset($excelFile);
    unset($excelApp);

    return true;
}