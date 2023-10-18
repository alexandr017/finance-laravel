var search = (function () {
    var join = document.getElementsByClassName('search-form-js')[0],
        joinLink = document.getElementsByClassName('header-search-js')[0],
        indexClick = 0,
        searchInputBySite = document.getElementById('searchInputBySiteJs');
    return function () {
        var searchBtnClick = function () {
            if(joinLink != null) {
                joinLink.addEventListener("click", function (event) {
                    if (indexClick === 0) {
                        join.style.display = 'block';
                        join.classList.add('jsFadeIn');
                        indexClick = 1;
                        joinLink.classList.add('fa-remove');
                        searchInputBySite.focus();
                    }
                    else {
                        join.style.display = 'none';
                        indexClick = 0;
                        joinLink.classList.remove('fa-remove');
                    }
                    event.stopPropagation();
                }, false);
            }
        }
        var searchHintLiClick = function () {
            let searchHintBlock = document.getElementById('search-hint');
            let liElements = searchHintBlock.getElementsByTagName('li');
            for (let i =0;i<liElements.length;i++) {
                liElements[i].addEventListener("click", function (event) {
                    document.getElementById('searchInputBySiteJs').value = event.target.innerHTML;
                    let formBlock = document.getElementsByClassName('search-wrap-form')[0];
                    formBlock.getElementsByTagName('form')[0].submit();
                    event.stopPropagation();
                }, false);
            }
        }
        var searchByInputKeyPress = function(){
            if(searchInputBySite != null) {
                searchInputBySite.addEventListener("input", function (event) {
                    const metas = document.getElementsByTagName('meta');
                    for (let i = 0; i < metas.length; i++) {
                        if (metas[i].getAttribute('name') === 'csrf-token') {
                            var token = metas[i].getAttribute('content');
                        }
                    }
                    var inpValue = this.value;
                    let searchHint = document.getElementById('search-hint');
                    if(inpValue.length > 2) {
                        (async function(){
                            let data = {
                                s: inpValue
                            };
                            let current_url = window.location.pathname;
                            let response = await fetch('/forms/search_hint_js', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json;charset=utf-8',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify(data)
                            });
                            let result = await response.text();
                            result = JSON.parse(result);
                            if(result.length  > 0) {
                                var res = '';
                                for (i = 0; i < result.length; i++) {
                                    if (result[i] != null) res = res + "<li>" + result[i] + "</li>";
                                }
                                searchHint.innerHTML = res;
                                searchHintLiClick();
                                searchHint.style.display = 'block';
                            }
                        })()
                    } else {
                        searchHint.innerHTML = '';
                        searchHint.style.display = 'none';
                    }

                }, false);
            }
        }
        searchBtnClick();
        searchByInputKeyPress();
    }
}());
search();