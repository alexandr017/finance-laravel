
    <div class="row footer-menu-flex-wrap footer-menu-wrap">
        <div class="footer-menu-flex-item d-md-block d-none">
            <div class="footer-menu-inner">
                <?php
                $menu = response::getMenu(4);
                if($menu != null){
                    $menu_name = $menu->menu_name;
                    echo "<div class=\"footer-menu-title\">$menu_name</div>";
                    $menu = json_decode($menu->code);
                    echo "<ul>";
                    foreach ($menu as $key => $value) {
                        echo "<li>";
                        $value_text_menu = $value->text;
                        if($value_text_menu == 'Автокредиты') $value_text_menu = 'Автокредиты <small class="red-menu-label">new</small>';
                        if($value_text_menu == 'Страхование') $value_text_menu = 'Страхование <small class="red-menu-label">new</small>';
                        if($value->target != 'default'){
                            if($value->title == 'javascript'){
                                echo "<a rel=\"".$value->target."\" href=\"javascript:window.location.href='".$value->href."'\">".$value_text_menu."</a>";
                            } else {
                                echo "<a rel=\"".$value->target."\" href=\"".$value->href."\">".$value_text_menu."</a>";
                            }
                        } else {
                            echo "<a href=\"".$value->href."\">".$value_text_menu."</a>";
                        }
                        echo "</li>";
                    }
                    echo "</ul>";
                } ?>
            </div>
        </div>
        <div class="footer-menu-flex-item d-md-block d-none">
            <div class="footer-menu-inner">
                <?php
                $menu = response::getMenu(5);
                if($menu != null){
                    $menu_name = $menu->menu_name;
                    echo "<div class=\"footer-menu-title\">$menu_name</div>";
                    $menu = json_decode($menu->code);
                    echo "<ul>";
                    foreach ($menu as $key => $value) {
                        echo "<li>";
                        if($value->target != 'default'){
                            if($value->title == 'javascript'){
                                echo "<a rel=\"".$value->target."\" href=\"javascript:window.location.href='".$value->href."'\">".$value->text."</a>";
                            } else {
                                echo "<a rel=\"".$value->target."\" href=\"".$value->href."\">".$value->text."</a>";
                            }
                        } else {
                            echo "<a href=\"".$value->href."\">".$value->text."</a>";
                        }
                        echo "</li>";
                    }
                    echo "</ul>";
                } ?>
            </div>
        </div>
        <div class="footer-menu-flex-item d-md-block d-none">
            <div class="footer-menu-inner">
                <?php
                $menu = response::getMenu(6);
                if($menu != null){
                    $menu_name = $menu->menu_name;
                    echo "<div class=\"footer-menu-title\">$menu_name</div>";
                    $menu = json_decode($menu->code);
                    echo "<ul>";
                    foreach ($menu as $key => $value) {
                        echo "<li>";
                        if($value->target != 'default'){
                            if($value->title == 'javascript'){
                                echo "<a rel=\"".$value->target."\" href=\"javascript:setTimeout(function(){document.location.href='".$value->href."';},500);\">".$value->text."</a>";
                            } else {
                                echo "<a rel=\"".$value->target."\" href=\"".$value->href."\">".$value->text."</a>";
                            }
                        } else {
                            echo "<a href=\"".$value->href."\">".$value->text."</a>";
                        }
                        echo "</li>";
                    }
                    echo "</ul>";
                } ?>
            </div>

            <br>
            <br>
            <div class="footer-menu-inner">
                <?php
                $menu = response::getMenu(7);
                if($menu != null){
                    $menu_name = $menu->menu_name;
                    echo "<div class=\"footer-menu-title\">$menu_name</div>";
                    $menu = json_decode($menu->code);
                    echo "<ul>";
                    foreach ($menu as $key => $value) {
                        if($value->href == 'https://bitcoin.vsezaimyonline.ru' || $value->href == 'https://cryptorate.vsezaimyonline.ru/') $js = "window.open('$value->href')";
                        else $js = "window.location.href='$value->href'";

                        echo "<li>";
                        if($value->target != 'default'){
                            if($value->title == 'javascript'){
                                echo "<a rel=\"".$value->target."\" href=\"javascript:setTimeout(function(){document.location.href='".$value->href."';},500);\">".$value->text."</a>";
                            } else {
                                echo "<a rel=\"".$value->target."\" href=\"".$value->href."\">".$value->text."</a>";
                            }
                        } else {
                            echo "<a href=\"".$value->href."\">".$value->text."</a>";
                        }
                        echo "</li>";
                    }
                    echo "</ul>";
                } ?>

            </div>

        </div>
        <div class="footer-menu-flex-item footer-menu-flex-menu d-md-block d-none">
            <div class="contacts-l-wrap">
                <div class="contacts-l-wrap-item">
                    <span class="fcg">Горячая линия</span>
                    <span class="block">Бесплатный номер телефона по России:</span>
                    <p class="phone"><i class="fa fa-phone"></i> <a href="tel:88007073397">8 (800) 707-33-97</a></p>
                </div>
                <div class="contacts-l-wrap-item">
                    <span class="fcg">Способы связи:</span>
                    <p class="itcs"><i class="fa fa-clock-o"></i><button data-toggle="modal" data-target="#callMe">Заказать обратный звонок</button></p>
                    <p class="itcs"><i class="fa fa-envelope-o"></i><a rel="nofollow" href="mailto:vzo@vsezaimyonline.ru">vzo@vsezaimyonline.ru</a></p>
                    <p class="itcs"><i class="fa fa-telegram"></i> <a href="https://t.me/vsezaimyonline" target="_blank" rel="nofollow">@vsezaimyonline</a></p>
                    <p class="itcs"><i class="fa fa-whatsapp"></i> <a href="https://wa.me/79951016228" target="_blank" rel="nofollow">8 (995) 101-62-28</a></p>
                </div>
            </div>
        </div>
    </div>
    <style>
        .footer-menu-flex-wrap{display: flex}
        .footer-menu-flex-item{width: 25%; padding: 0 15px;}
        .contacts-l-wrap-item{margin-bottom: 30px;}
        @media  (max-width: 1200px){
            .footer-menu-flex-item{width: 33.3%; }
            .footer-menu-flex-item{}
            .footer-menu-flex-menu{width: 100%}
            .contacts-l-wrap {margin-top: 15px;margin-bottom: 0;}
            .contacts-l-wrap{display: flex}
            .contacts-l-wrap-item{width: 50%}

        }
        @media  (max-width: 992px){

        }
        @media  (max-width: 776px){
            .footer-menu-flex-item{}
            .contacts-l-wrap-item{width: 100%}
        }
    </style>
