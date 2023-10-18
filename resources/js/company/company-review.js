function openReview(e) {
    if (e.id === "read_more_open") {
        let id = e.parentNode.querySelector("input[type='checkbox']").dataset.parent_id;

        e.parentNode.parentNode.remove();

        document.getElementById(id).dataset.open = "";
        document.body.parentNode.style.overflowY = "unset";

    } else {
        if ( e.dataset.open !== "true" ) {
            e.dataset.open = "true";

            let bg = document.createElement("label");
            bg.className = "review_card-cont_bg";
            bg.setAttribute('for', "read_more_open");

            let clone = e.parentElement.cloneNode(true);
            clone.classList.add('open');
            clone.classList.add('dop_open');

            clone.querySelector("input[type='checkbox']").id="read_more_open";
            clone.querySelector("input[type='checkbox']").dataset.parent_id=e.id;
            clone.querySelectorAll("label").forEach((item, i) => {
                item.setAttribute('for', "read_more_open");
            });
            clone.querySelector('#read-all').remove();

            bg.appendChild(clone);

            if(document.body.clientWidth <= 860){
             document.body.parentNode.style.overflowY = "hidden";
            }

            document.body.appendChild(bg);
        }
    }
}

function handleCategoryItems(event) {
    event.target.parentElement.querySelector('#category-items-second-part').style.display = event.target.checked ? 'block' : 'none';
}
