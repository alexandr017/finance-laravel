function sortingArrows(elem) {

    if(elem.parentNode.classList.contains('active')){
        if(elem.parentNode.children[0].classList.contains('fa-arrow-circle-up')){
            elem.parentNode.children[0].classList.remove('fa-arrow-circle-up');
            elem.parentNode.children[0].classList.add('fa-arrow-circle-down');
            window.sort_type = 'desc';
        } else {
            window.sort_type = 'asc';
            elem.parentNode.children[0].classList.add('fa-arrow-circle-up');
            elem.parentNode.children[0].classList.remove('fa-arrow-circle-down');
        }
        window.default_sorting_counter = 0;
    } else {

        document.querySelectorAll('.sorting-line li').forEach(sortingLineElem => {
            sortingLineElem.classList.remove('active');
            if (sortingLineElem.children[0] != undefined)
                sortingLineElem.children[0].setAttribute('class','');
        });

        elem.parentNode.children[0].classList.add('fa-arrow-circle-down');
        elem.parentNode.children[0].classList.add('fa');
        elem.parentNode.classList.add('active');

    }

}