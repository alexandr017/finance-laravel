
let sortOrder;
let sortValue;
let showMoreItems = false;
let page = 1;

function showMore() {
    showMoreItems = true;

    this.sendRequest();
}


function sendRequest ()
{
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (showMoreItems) {
        page ++;
    } else {
        page = 1
    }

    let url = `/companies/${companyId}/reviews?page=${page}`;

    if (sortValue && sortOrder) {
        url += `&sort_value=${sortOrder}&sort_key=${sortValue}`
    }

    fetch(`${url}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    })
        .then(response => response.text())
        .then(data => {
            let block
            if (showMoreItems) {
                block = document.getElementById('reviews-block')
                const parser = new DOMParser();
                const parsedHTML = parser.parseFromString(data, 'text/html');

                const fragment = parsedHTML.documentElement;

                let items = fragment.getElementsByClassName('review-card');
                const itemsArray = Array.from(items);

                itemsArray.forEach(function (item) {
                    block.appendChild(item)
                })
                showMoreItems = false;
            } else {
                block = document.getElementById('reviews-block-all')
                block.innerHTML = data
            }
        })
        .catch(error => {
            alert('Something went wrong');
            console.error('Error:', error);
        });
}


function sortPanel(evt, companyId) {
    const element = evt.target;
    console.log(element)
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

function updateSortButtons () {
    const elements = document.querySelectorAll('.product-sort-btn.active');

    elements.forEach(element => {
        element.classList.remove('active');
        element.setAttribute('data-sort-order', '');
        element.querySelector('img').setAttribute('src', '/images/sort-panel/arrow_up_black.svg');
    });
}