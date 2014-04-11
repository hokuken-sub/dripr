<?php
    $link = array();

    $view  = isset($_GET['edit']) ? $_GET['edit'] : 'index';
    $theme = isset($_GET['theme']) ? $_GET['theme'] : 'landing';

    if ($theme !== '')
    {
      $link[] = '<link rel="stylesheet" href="./themes/'.$theme.'/style.css" />';
    }
    
    $link = join("\n", $link);  
    
    ob_start();
    
    include('./views/'.$view.'.html');
    $content = ob_get_contents();
    
    ob_end_clean();
    
    require_once('./master.html');


