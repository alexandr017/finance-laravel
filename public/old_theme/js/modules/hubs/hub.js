document.querySelectorAll(".sorting-line span").forEach(el => {
    //el.addEventListener('click', sortingArrows);
    el.addEventListener('click',fn => {
        sortingArrows(el);
    });
});