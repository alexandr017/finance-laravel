function showNew(event, direction) {
    const swiperContainer = event.target.parentElement.parentElement.querySelector('.swiper-wrapper');
    const cardContainers = swiperContainer.querySelectorAll('.news-cont');
    const prevButton = swiperContainer.parentElement.querySelector('#prev_button');
    const nextButton = swiperContainer.parentElement.querySelector('#next_button');
    const currentPage = swiperContainer.parentElement.querySelector('.swiper-pagination #current-page');
    let currentIndex  = (+currentPage.textContent - 1) * 2;

    if ((direction === 'next' && currentIndex + 8 >= cardContainers.length) || (direction === 'prev' && currentIndex <= 0)) {
            return;
    }

    cardContainers[currentIndex].classList.toggle('swiper-slide-pasive', direction === 'next');
    cardContainers[currentIndex + 1].classList.toggle('swiper-slide-pasive', direction === 'next');
    currentPage.textContent = direction === 'next' ?  +currentPage.textContent + 1 :  +currentPage.textContent - 1;
    nextButton.setAttribute('aria-disabled', direction === 'next' ? (currentIndex + 8 >= cardContainers.length).toString() : 'false');
    prevButton.setAttribute('aria-disabled', direction === 'prev' ? (currentIndex <= 0).toString() : 'false');
    nextButton.classList.toggle('swiper-button-disabled', direction === 'next' && currentIndex + 8 >= cardContainers.length);
    prevButton.classList.toggle('swiper-button-disabled', direction === 'prev' && currentIndex <= 0);

    nextButton.setAttribute('aria-disabled', currentIndex + 8 >= cardContainers.length);
    prevButton.setAttribute('aria-disabled', currentIndex <= 0);
    nextButton.classList.toggle('swiper-button-disabled', currentIndex + 8 >= cardContainers.length);
    prevButton.classList.toggle('swiper-button-disabled', currentIndex <= 0);
}
