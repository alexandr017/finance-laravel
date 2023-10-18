function showCards(event, direction, cardContainerName) {
    const swiperContainer = event.target.parentElement.parentElement;
    const cardContainers = swiperContainer.querySelectorAll(`.${cardContainerName}`);
    const prevButton = swiperContainer.querySelector('#prev_button');
    const nextButton = swiperContainer.querySelector('#next_button');
    const currentPage = swiperContainer.querySelector('.swiper-pagination #current-page');
    const currentIndex = parseInt(currentPage.textContent) - 1;

    if ((direction === 'next' && currentIndex + 4 >= cardContainers.length) || (direction === 'prev' && currentIndex <= 0)) {
        return;
    }

    cardContainers[currentIndex].classList.toggle('swiper-slide-pasive', direction === 'next');
    currentPage.textContent = direction === 'next' ? currentIndex + 2 : currentIndex;
    nextButton.setAttribute('aria-disabled', direction === 'next' ? (currentIndex + 4 >= cardContainers.length).toString() : 'false');
    prevButton.setAttribute('aria-disabled', direction === 'prev' ? (currentIndex <= 0).toString() : 'false');
    nextButton.classList.toggle('swiper-button-disabled', direction === 'next' && currentIndex + 4 >= cardContainers.length);
    prevButton.classList.toggle('swiper-button-disabled', direction === 'prev' && currentIndex <= 0);
}
