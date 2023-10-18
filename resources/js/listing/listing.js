
let sortOrder;
let sortValue;
let tagsFilters = [];
let showMoreItems = false;
let page = 1;

function handleShowFilters() {
    const filters = document.getElementById('filtersList');

    filters.style.display === 'none' ?
        filters.style.display = '' :
        filters.style.display = 'none'
}

function showMore() {
    showMoreItems = true;

    this.sendRequest();
}

function sortPanelAjax(evt, listingId) {
    const element = evt.target;
    const img = element.querySelector('img');

    sortOrder = element.getAttribute('data-sort-order');
    sortValue = element.getAttribute('data-sort-value');


    if (!sortOrder) {
        updateSortButtons();
    }

    if (!element.classList.contains('active')) {
        element.classList.add('active');
    }

    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
    let src = sortOrder === 'desc' ? '/images/sort-panel/arrow_down_blue.svg' : '/images/sort-panel/arrow_up_blue.svg'
    element.setAttribute('data-sort-order', sortOrder);
    img.setAttribute('src', src)

    this.sendRequest()
}

function sendRequest ()
{
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (showMoreItems) {
        page ++;
    } else {
        page = 1
    }

    let url = `/listings/${listingId}/courses?page=${page}`;

    if (sortValue && sortOrder) {
        url += `&sort_value=${sortOrder}&sort_key=${sortValue}`
    }

    if (tagsFilters.length) {
        tagsFilters.forEach(function (tagfilter) {
            url += `&tags[]=${tagfilter}`
        })
    }


    fetch(`${url}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    })
        .then(response => response.text())
        .then(data => {
            let block = document.getElementById('courses_block')
            if (showMoreItems) {
                const parser = new DOMParser();
                const parsedHTML = parser.parseFromString(data, 'text/html');

                const fragment = parsedHTML.documentElement;

                let items = fragment.getElementsByClassName('course-element');
                const itemsArray = Array.from(items);

                itemsArray.forEach(function (item) {
                    block.appendChild(item)
                })
                showMoreItems = false;
            } else {
                block.innerHTML = data
            }
        })
        .catch(error => {
            alert('Something went wrong');
            console.error('Error:', error);
        });
}

function updateSortButtons () {
    const elements = document.querySelectorAll('.product-sort-btn.active');

    elements.forEach(element => {
        element.classList.remove('active');
        element.setAttribute('data-sort-order', '');
        element.querySelector('img').setAttribute('src', '/images/sort-panel/arrow_up_black.svg');
    });
}

function handleTagFilter (tagId)
{
    if (tagsFilters.includes(tagId)) {
        let index = tagsFilters.indexOf(tagId);
        tagsFilters.splice(index, 1);
    } else {
        tagsFilters.push(tagId);
    }

    this.sendRequest();

}