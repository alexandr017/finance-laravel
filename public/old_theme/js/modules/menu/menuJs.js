var menuJs = (function () {
    return function () {
        var show = function (elem) {
            if(elem.getElementsByTagName('ul')){
                elem.getElementsByTagName('ul')[0].style.display = 'block';
            }
        }
        var close = function (elem) {
            if(elem.getElementsByTagName('ul')){
                elem.getElementsByTagName('ul')[0].style.display = 'none';
            }
        }
        var showMobileMenu = function () {
            var mobMenuBtn = document.getElementById('menu-mob-button-js');
            if(mobMenuBtn != null) {
                mobMenuBtn.addEventListener("click", function (event) {
                    var mobMenu = document.getElementsByClassName('mob-menu-wrap');
                    if(mobMenu.length != 0){
                        mobMenu = mobMenu[0];
                        mobMenu.style.display = 'block';
                        mobMenu.classList.add('jsSmoothAnimateRL');
                        mobMenu.classList.remove('jsSmoothAnimateLR');
                        var mobMenuCloseBtn = mobMenu.getElementsByClassName('mob-close-js')[0];
                        if(mobMenuCloseBtn != null) {
                            mobMenuCloseBtn.addEventListener("click", function (event) {
                                var mobMenu = document.getElementsByClassName('jsSmoothAnimateRL');
                                if(mobMenu.length != 0){
                                    mobMenu = mobMenu[0];
                                    mobMenu.style.display = 'block';
                                    mobMenu.classList.add('jsSmoothAnimateLR');
                                    mobMenu.classList.remove('jsSmoothAnimateRL');
                                }
                            }, false);
                        }
                    }
                }, false);
            }
        }
        if (window.innerWidth > 769) {
            var menuElems = document.getElementsByClassName('jsMenuLi');
            for (let i = 0; i < menuElems.length; i++) {
                menuElems[i].addEventListener("mouseover", function (event) {
                    event.target.onmouseover = show(menuElems[i]);
                }, false);
                menuElems[i].addEventListener("mouseout", function (event) {
                    event.target.onmouseout = close(menuElems[i]);
                }, false);
            }
        } else {
            showMobileMenu();
            var mobMenuBtn = document.getElementById('menu-mob-button-js');
            if(mobMenuBtn != null) {
                mobMenuBtn.style.display = 'inline-block';
            }
        }
    }
}());
menuJs();