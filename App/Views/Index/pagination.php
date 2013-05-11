<div id="pagination_text">Pages:</div>
<?php
    if(!isset($page)) $page = 1;
    if(!isset($perPage) || empty($perPage)) $perPage = 1;
    $maxPage = ceil($cnt/$perPage);
    for($i=1;$i<=$maxPage;$i++){
        if($i==$page){
            echo '<div id="page_item_active">' . $i . '</div>';
            continue;
        }
        if($i==1 || $i==$maxPage || ($i>=$page-2 && $i<=$page+2)){
            echo '<a href="#" id="page_' . $i . '" class="page_item">' . $i . '</a>';
            continue;
        }
        if(($i==$page-3 || $i==$page+3) && $i!=1 && $i!=$maxPage){
            echo '<div class="page_points">..</div>';
        } 
    }
?>

