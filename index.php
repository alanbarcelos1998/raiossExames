<?php
    require_once 'app/Controller/ErrorController.php';
    require_once 'app/Controller/ExamController.php';
    require_once 'vendor/autoload.php';

    use App\Core\Core;

    $template = file_get_contents('app/Template/skeleton.html');

    ob_start();
        $core = new Core($_GET);
        $out = ob_get_contents();
    ob_end_clean();

    $templateEnd = str_replace('{{data_area}}', $out, $template);

    echo $templateEnd;