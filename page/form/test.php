<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$inputFileName = '../../application//grade/111.xls';


$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../../application//grade/111.xls');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Html');
$writer->save('write.html');
?>
