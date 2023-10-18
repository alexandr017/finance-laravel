const ratingGroup = document.querySelector('#half-stars-example .rating-group');
const ratingLabels = ratingGroup.querySelectorAll('.rating__label');
let rate;

ratingLabels.forEach((label, index) => {
    label.addEventListener('mouseover', () => {
        const labelsBeforeTarget = Array.from(ratingLabels).slice(0, index + 1);
        ratingLabels.forEach(label => label.classList.remove('hovered'));
        labelsBeforeTarget.forEach(label => label.classList.add('hovered'));
    });

    if (rate === undefined) {
        ratingGroup.addEventListener('mouseout', resetShowRating);
    }

    label.addEventListener('mousedown', handleRating)
});

function handleRating(evt) {
    rate = evt.target.parentElement.attributes["aria-label"].nodeValue;

    ratingLabels.forEach(function (label) {
        if (label.getAttribute('aria-label') <= rate) {
            label.classList.add('hovered')
        }
    })
}

function resetShowRating(evt) {
    ratingLabels.forEach(label => label.classList.remove('hovered'));

    ratingLabels.forEach(function (label) {
        if (label.getAttribute('aria-label') <= rate) {
            label.classList.add('hovered')
        } else {
            label.classList.remove('hovered')
        }
    })
}
