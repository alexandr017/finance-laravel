var horizontalTabsJs = (function () {
    return function () {
        // var itopItems = document.getElementsByClassName('itop-js')
        // var addIconAndClick = function (itopItems) {
        //     for(let i=0;i<itopItems.length;i++){
        //         itopItems[i].innerHTML = '<i class="fa fa-plus"></i>'+itopItems[i].innerHTML;
        //         itopItems[i].addEventListener("click", function (event) {
        //             openImoreBlock(event.target);
        //         }, false);
        //     }
        // }
        // var openImoreBlock = function (elem) {
        //     if(elem.parentNode.getElementsByClassName('fa-plus')[0]){
        //         elem.parentNode.getElementsByClassName('fa-plus')[0].classList.add('fa-minus');
        //         elem.parentNode.getElementsByClassName('fa-plus')[0].classList.remove('fa-plus');
        //         elem.parentNode.nextElementSibling.style.display = 'block';
        //     }else{
        //         elem.parentNode.nextElementSibling.style.display = 'none';
        //         elem.parentNode.getElementsByClassName('fa-minus')[0].classList.add('fa-plus');
        //         elem.parentNode.getElementsByClassName('fa-plus')[0].classList.remove('fa-minus');
        //     }
        // }
        // addIconAndClick(itopItems);
    }
}());
horizontalTabsJs();