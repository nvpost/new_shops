<?php


function getMenu($parent_id){
    $sql = "SELECT * FROM category WHERE parent_id=".$parent_id;
    $rootCats = pdSql($sql);

    foreach($rootCats as $k=>$c){
        $level = tree($c);
        $rootCats[$k]['childs'] = $level;
    }

    return $rootCats;
}




function tree($cat){
    $childCats = getCats($cat['cat_id']);
    foreach ($childCats as $ck => $cc){
        $prods_count = getProdsCount($cc['cat_id']);
        if($prods_count==0){
            $next_level = getCats($cc['cat_id']);
            //deb($next_level);
            $childCats[$ck]['childs'] = $next_level;
        }
        $childCats[$ck]['prods_count'] = $prods_count;
    }
    return $childCats;
}

function getCats($cat_id){
    $sql = "SELECT * FROM category WHERE parent_id=".$cat_id;
    $childCats = pdSql($sql);
    return $childCats;
}

function getProdsCount($cat_id){
    $sql = "SELECT * FROM products WHERE category_id=".$cat_id;
    $prods = pdSql($sql);
    return count($prods);
}


//Проверка кеша
function checkMainMenuCache($cacheName){
    // Название кеша - каталог с количеством
    //deb($cacheName);
    $dataCache = new DataCache($cacheName);
    $getDataFromCache = $dataCache->initCacheData();

    if ($getDataFromCache) {
        // Получаем кэшированные данные из кэша
        //echo "из cache";
        $data = $dataCache->getCacheData();
        //deb($products);
    } else {
        // Исполняем этот код, если кеширование отключено или данные в кеше старые
        //echo "Новый список товаров";
        $data = getMenu(0);
        //     Обновляем данные в кэше
        $dataCache->updateCacheData($data);
    }
    return $data;
}