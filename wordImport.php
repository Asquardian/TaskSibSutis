<?php
require 'vendor/autoload.php';
session_start();
if (!isset($_SESSION["nameOfStudent"])) {
    header("Location: http://localhost/TaskSibSutis/login.php");
}
if (isset($_SESSION["array"])) {
    $arrayState = $_SESSION["array"];
    wordImport($arrayState);
} else {
    exit();
}

function wordImport($arrayState)
{
    $word = new  \PhpOffice\PhpWord\PhpWord();
    $word->setDefaultFontName('Times New Roman');
    $word->setDefaultFontSize(12);
    $properties = $word->getDocInfo();


    $sectionStyle = array(
        'orientation' => 'landscape',
        'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(50),
        'marginLeft' => 1500,
        'marginRight' => 1000,
        'colsNum' => 1,
        'pageNumberingStart' => 1,
    );


    $section = $word->addSection($sectionStyle);
    $section->addImage('img/sibs.jpg',
        array('width' => 100,
            'height' => 100,
            'align' => 'left'));
    $fontStyle = array('name' => 'Times New Roman', 'size' => 32);
    $parStyle = array('align' => 'center', 'spaceBefore' => 1000, "spaceAfter" => 1000);
    $word->addTitleStyle(1, $fontStyle, $parStyle);


    $section->addTitle(htmlspecialchars("Заявление\n"));
    $section->addText(htmlspecialchars("\tЯ, студент группы " . $arrayState[1] . " " . $arrayState[0] .
        " подал завяление на получение справки " . $arrayState[3] .
        " в количестве " . $arrayState[2] . "."));
    $section->addText(htmlspecialchars("Подпись студента________________\n"), null, array('spaceBefore' => 2500, 'align' => 'right'));
    $section->addText(htmlspecialchars("Печать________________\n"), null, array('spaceBefore' => 100, 'align' => 'right'));


    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007', $download = true);


    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="Заявление.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');

    $objWriter->save("php://output");
    exit();
}


?>