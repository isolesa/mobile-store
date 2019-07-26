<?php

ob_clean();

header("Content-Type: application/octet-stream");

header("Content-Disposition: attachment; filename=download.xls");

readfile(BASE_URL."/data/excel/urls.xls");