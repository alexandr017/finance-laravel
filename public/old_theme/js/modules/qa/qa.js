document.addEventListener('DOMContentLoaded', function () {
    push_vote = function (answerId, vote, element) {
        const metas = document.getElementsByTagName('meta');
        for (let i = 0; i < metas.length; i++) {
            if (metas[i].getAttribute('name') === 'csrf-token') {
                var token = metas[i].getAttribute('content');
            }
        }
        (async function () {
            let data = {
                answerId: answerId,
                vote: vote
            };
            let response = await fetch('/qa/answer/voting', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(data)
            });
            let result = await response.text();
            result = JSON.parse(result);
            if (result.result == 1) {
                // if (result.changeVote != undefined && result.changeVote == 1) {
                //     result.message += '<br><a rel="nofollow" class="deleteVote" href="#">Отменить голосование и проголосовать заново</a>'
                // }else {
                // }
                let parentBlock = element.target.parentElement.parentElement
                if(parentBlock.getElementsByClassName('changeVoteColor').length > 0){
                    parentBlock.getElementsByClassName('changeVoteColor')[0].nextElementSibling.innerText = parseInt(parentBlock.getElementsByClassName('changeVoteColor')[0].nextElementSibling.innerText) - 1;
                    parentBlock.getElementsByClassName('changeVoteColor')[0].classList.remove('changeVoteColor');
                    return;
                }
                if(result.changeVote != undefined && result.changeVote == 1 && parentBlock.getElementsByClassName('changeVoteColor').length == 0){
                    element.target.nextElementSibling.innerText = parseInt(element.target.nextElementSibling.innerText) - 1;
                    element.target.classList.remove('changeVoteColor');
                } else {
                    element.target.classList.add('changeVoteColor');
                    element.target.nextElementSibling.innerText = parseInt(element.target.nextElementSibling.innerText) + 1;
                }
            }
        })()
    }
    createForm = function (message) {
        let formModal = document.getElementById('formModal');
        formModal.getElementsByClassName('modal-body')[0].innerHTML = '<p>' + message + '</p>'
        formModal.style.display = 'block';
        formModal.style.opacity = 1;
        formModal.getElementsByClassName('close')[0].addEventListener("click", function (event) {
            formModal.style.display = 'none';
            formModal.style.opacity = 0;
        }, false);
    }
    var upLikesElements = document.getElementsByClassName('pushUpLike');
    for (let i = 0; i < upLikesElements.length; i++) {
        upLikesElements[i].addEventListener("click", function (event) {
            let answerId = event.target.closest('.answer-item').dataset['id'];
            push_vote(answerId, 1, event);
            event.stopPropagation();
        }, false);
    }
    var downLikesElements = document.getElementsByClassName('pushDownLike');
    for (let i = 0; i < downLikesElements.length; i++) {
        downLikesElements[i].addEventListener("click", function (event) {
            let answerId = event.target.closest('.answer-item').dataset['id'];
            push_vote(answerId, 0, event);
            event.stopPropagation();
        }, false);
    }

    var qaSearch = document.getElementsByClassName('qa-search');
    if(qaSearch.length >0 ){
        qaSearch[0].addEventListener("click", function (event) {
            const metas = document.getElementsByTagName('meta');
            for (let i = 0; i < metas.length; i++) {
                if (metas[i].getAttribute('name') === 'csrf-token') {
                    var token = metas[i].getAttribute('content');
                }
            }
            let elem = event.target;
            let qaSearchHint = document.getElementById('searchQa').value;
            if(qaSearchHint.length > 2) {
                (async function () {
                    let data = {
                        searchHint: qaSearchHint
                    };
                    let response = await fetch('/qa/search', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify(data)
                    });
                    let result = await response.text();
                    if (result != '') {
                        document.getElementsByClassName('qa-items-block')[0].innerHTML = result;
                        document.getElementById('load-more-qa').style.display = 'none';
                    }
                })()
            } else {
                location.reload();
            }
        }, false);
    }

    var searchInp = document.getElementById('searchQa');
    if(searchInp) {
        searchInp.addEventListener("keyup", function (event) {
            let searchInpValue = searchInp.value;
            if(searchInpValue.length == '') {
                location.reload();
            }
            event.stopPropagation();
        }, false);
    }

    // if(document.getElementsByClassName('add-answer').length > 0) {
    //     document.getElementsByClassName('add-answer')[0].addEventListener("click", function (event) {
    //         document.getElementsByClassName('addAnswerBlockForComment')[0].style.display = 'none';
    //         document.getElementsByClassName('addAnswerBlock')[0].style.display = 'block';
    //         document.getElementById('addCommentTo').style.display = 'none';
    //         event.stopPropagation();
    //     }, false);
    // }

    if (document.getElementById('addAnswer')) {
        document.getElementById('addAnswer').addEventListener("click", function (event) {
            let alertMsg = '';
            let userName = '';
            let userNameBlock = document.getElementById('userName');
            // document.getElementsByClassName('addAnswerBlockForComment')[0].style.display = 'none';
            let token = document.getElementById('key').value;
            let qaId = document.getElementById('qa_id').value;
            let answerText = document.getElementById('answer-text').value;
            if(userNameBlock && userNameBlock.value == ''){
                alertMsg = 'Заполните поле "Имя"';
            } else {
                userName = userNameBlock.value;
            }
            if(answerText == ''){
                alertMsg = 'Заполните поле "Ответ"';
            }
            if(answerText == '' && userNameBlock.value == ''){
                alertMsg = 'Заполните поля "Имя" и "Ответ"';
            }
            var captcha = '';
            if(document.getElementById('g-recaptcha-response')) {
                captcha = document.getElementById('g-recaptcha-response').value
                if(captcha == ''){
                    alertMsg = 'Пройдите проверку "Я не робот"';
                }
            }
            if(alertMsg != ''){
                let formModal = document.getElementById('formModal');
                formModal.getElementsByClassName('modal-body')[0].innerHTML = '<p>'+alertMsg+'</p>';
                formModal.style.display = 'block';
                formModal.style.opacity = 1;
                formModal.getElementsByClassName('close')[0].addEventListener("click", function (event) {
                    formModal.style.display = 'none';
                    formModal.style.opacity = 0;
                }, false);
                return;
            }
            let parent_id = document.getElementById('addCommentTo').dataset.id;
            (async function () {
                let data = {
                    qaId: qaId,
                    answerText: answerText,
                    parent_id : parent_id,
                    userName : userName,
                    captcha : captcha
                };
                let response = await fetch('/qa/add/answer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(data)
                });
                let result = await response.text();
                result = JSON.parse(result);
                if (result.result == 1) {
                    let formModal = document.getElementById('formModal');
                    formModal.getElementsByClassName('modal-body')[0].innerHTML = '<p>' + result.message + '</p>'
                    formModal.style.display = 'block';
                    formModal.style.opacity = 1;
                    formModal.getElementsByClassName('close')[0].addEventListener("click", function (event) {
                        formModal.style.display = 'none';
                        formModal.style.opacity = 0;
                    }, false);
                    // userNameBlock.value = '';
                    document.getElementById('answer-text').value = '';
                }
            })()

            event.stopPropagation();
        }, false);
    }
    if(document.getElementById('load-more-qa')){
        document.getElementById('load-more-qa').addEventListener("click", function (event) {
            const metas = document.getElementsByTagName('meta');
            for (let i = 0; i < metas.length; i++) {
                if (metas[i].getAttribute('name') === 'csrf-token') {
                    var token = metas[i].getAttribute('content');
                }
            }

            let loadedQaCount = document.getElementsByClassName('question-item').length;
            let sortBlock = document.getElementsByClassName('new-popular-block')[0];
            let sortActiveItem = sortBlock.getElementsByClassName('active')[0].dataset.name;
            let activeTag = document.getElementsByClassName('active-tag')[0].dataset.cat;
            (async function () {
                let data = {
                    offset: loadedQaCount,
                    sortActiveItem: sortActiveItem,
                    activeTag: activeTag
                };
                let response = await fetch('/qa/load-more', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(data)
                });
                let result = await response.text();
                if (result != '' && response.ok == true) {
                    result = JSON.parse(result);
                    var parser = new DOMParser();
                    var qaItems = parser.parseFromString(result.qaItem, 'text/html');
                    for (let i = qaItems.body.children.length; i > 0; i--) {
                        document.getElementsByClassName('qa-items-block')[0].append(qaItems.body.children[0]);
                    }
                    var loadMoreBtn = document.getElementById('load-more-qa');
                    if(result.qaForLoad <= 0) {
                        loadMoreBtn.style.display = 'none';
                    }else{
                        loadMoreBtn.style.display = 'inline-block';
                    }
                } else {
                    event.target.style.display = 'none';
                }
            })()

            event.stopPropagation();
        }, false);
    }
    var qaComments = document.getElementsByClassName('qa-comment');
    for (let i = 0; i < qaComments.length; i++) {
        qaComments[i].addEventListener("click", function (event) {
            let parentElem = event.target.closest('.answer-item');
            let parent_id = parentElem.dataset.id;
            let answerAuthorName = parentElem.getElementsByClassName('qa-author')[0].dataset.name;
            let addCommentTo = document.getElementById('addCommentTo');
            addCommentTo.getElementsByTagName('b')[0].innerHTML = answerAuthorName;
            // document.getElementsByClassName('addAnswerBlock')[0].style.display = 'none';
            // document.getElementsByClassName('addAnswerBlockForComment')[0].style.display = 'block';
            addCommentTo.style.display = 'block';
            addCommentTo.dataset.id = parent_id;
            event.stopPropagation();
        }, false);
    }
    var qaCommentsBlocks = document.getElementsByClassName('answer-comments-count');
    for (let i = 0; i < qaCommentsBlocks.length; i++) {
        qaCommentsBlocks[i].addEventListener("click", function (event) {
            let parentElem = event.target.closest('.answer-item-text-block');
            let thisElComments = parentElem.getElementsByClassName('answer-comments');
            if(thisElComments != null){
                for (let i = 0; i < thisElComments.length; i++) {
                    thisElComments[i].style.display = 'block';
                }
            }
            event.stopPropagation();
        }, false);
    }
    var sortItems = document.getElementsByClassName('sort-item');
    for (let i = 0; i < sortItems.length; i++) {
        sortItems[i].addEventListener("click", function (event) {
            var sortItemBlock = document.getElementsByClassName('new-popular-block')[0];
            sortItemBlock.getElementsByClassName('active')[0].classList.remove('active');
            const metas = document.getElementsByTagName('meta');
            for (let i = 0; i < metas.length; i++) {
                if (metas[i].getAttribute('name') === 'csrf-token') {
                    var token = metas[i].getAttribute('content');
                }
            }
            event.target.classList.add('active');
            let sortActiveItem = sortItemBlock.getElementsByClassName('active')[0].dataset.name;
            let activeTag = document.getElementsByClassName('active-tag')[0].dataset.cat;
            (async function () {
                let data = {
                    sortActiveItem: sortActiveItem,
                    activeTag: activeTag
                };
                let response = await fetch('/qa/sort', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(data)
                });
                let result = await response.text();
                if (result != '' && response.ok == true) {
                    if(document.getElementById('load-more-qa')){
                        document.getElementById('load-more-qa').style.display = 'inline-block';
                    }
                    var parser = new DOMParser();
                    var qaItems = parser.parseFromString(result, 'text/html');
                    document.getElementsByClassName('qa-items-block')[0].innerHTML = '';
                    for (let i = qaItems.body.children.length; i > 0; i--) {
                        document.getElementsByClassName('qa-items-block')[0].append(qaItems.body.children[0]);
                    }
                }
            })()
            event.stopPropagation();
        }, false);
    }
});