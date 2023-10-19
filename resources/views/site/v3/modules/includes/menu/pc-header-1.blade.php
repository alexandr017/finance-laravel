<ul>
    <li class="jsMenuLi">Займы
        <ul>
            <li><a href="" class="dropdown-toggle-js">222</a></li>
            <li><a href="" class="dropdown-toggle-js">222</a></li>
        </ul>
    </li>
    <li class="jsMenuLi">Кредиты
        <ul>
            <li><a href="" class="dropdown-toggle-js">222</a></li>
            <li><a href="" class="dropdown-toggle-js">222</a></li>
        </ul>
    </li>
    <li class="jsMenuLi">Карты
        <ul>
            <li><a href="" class="dropdown-toggle-js">Кредитные карты</a></li>
            <li><a href="" class="dropdown-toggle-js">Дебетовые карты</a></li>
        </ul>
    </li>
</ul>

<?php


//$menu = response::getMenu(1);
//if($menu != null){
//    $menu = json_decode($menu->code);
//
//    echo "<ul>";
//    foreach ($menu as $key => $value) {
//        echo "<li class='jsMenuLi'>";
//
//        if($value->target != 'default'){
//
//            if($value->title == 'javascript'){
//                if(isset($value->children)){
//                    echo "<a rel=\"".$value->target."\" href=\"javascript:window.location.href='".$value->href."'\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">".str_replace('[arrow]', '<i class=\'fa fa-angle-double-right\'></i>', $value->text)."</a>";
//                } else {
//                    echo "<a rel=\"".$value->target."\" href=\"javascript:window.location.href='".$value->href."'\">".str_replace('[arrow]', '<i class=\'fa fa-angle-double-right\'></i>', $value->text)."</a>";
//                }
//            } else {
//                if(isset($value->children)){
//                    echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\" rel=\"".$value->target."\" href=\"".$value->href."\">".str_replace('[arrow]', '<i class=\'fa fa-angle-double-right\'></i>', $value->text)."</a>";
//                } else {
//                    echo "<a rel=\"".$value->target."\" href=\"".$value->href."\">".str_replace('[arrow]', '<i class=\'fa fa-angle-double-right\'></i>', $value->text)."</a>";
//                }
//            }
//        }
//
//
//        else {
//            if(isset($value->children)){
//                echo "<a class=\"dropdown-toggle-js\" href=\"".$value->href."\">".str_replace('[arrow]', '<i class=\'fa fa-angle-double-right\'></i>', $value->text)."</a>";
//            } else {
//                echo "<a href=\"".$value->href."\">".$value->text."</a>";
//            }
//
//
//        }
//        echo "<ul>";
//        foreach ($value->children as $key2 => $value2) {
//            echo "<li>";
//            $children_menu_text = trim($value2->text);
//            if($children_menu_text == 'Займ на карту' || $children_menu_text == 'Все МФО') $children_menu_text = '<span class="menu-green-background">' . $children_menu_text . '</span>';
//            if($value2->target != 'default'){
//                if($value2->title == 'javascript'){
//                    echo "<a class=\"". class_for_menu($value->href) ."\" rel=\"".$value2->target."\" href=\"javascript:window.location.href='".$value2->href."'\">". $children_menu_text."</a>";
//                } else {
//                    echo "<a class=\"". class_for_menu($value->href) ."\" rel=\"".$value2->target."\" href=\"".$value2->href."\">". $children_menu_text ."</a>";
//                }
//            } else {
//                echo "<a class=\"". class_for_menu($value->href) ."\" href=\"".$value2->href."\">". $children_menu_text ."</a>";
//            }
//            echo "</li>";
//        }
//        echo "</ul>";
//        echo "</li>";
//    }
//    echo "</ul>";
//}
?>