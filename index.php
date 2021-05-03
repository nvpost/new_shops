<?php

spl_autoload_register(function ($class_name) {
    include 'classes/'.$class_name . '.php';
});

$t = new TimeLogClass('вся страница');

require_once 'func/func.php';



$menuArr = checkMainMenuCache("MainMenu");


deb($menuArr);

c_deb("запросов к бд - ".$sql_count);




$t->timerStop();




