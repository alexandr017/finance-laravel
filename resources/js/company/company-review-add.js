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

function leaveReview(companyId)
{
    let name = document.getElementById(`name_${companyId}`).value;
    let pluses = document.getElementById(`pluses_${companyId}`).value;
    let minuses = document.getElementById(`minuses_${companyId}`).value;
    let content = document.getElementById(`content_${companyId}`).value;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/companies/${companyId}/reviews`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            name: name,
            pluses: pluses,
            minuses: minuses,
            content: content,
            rate: rate
        }),
    })
        .then(response => {
            location.reload()
        }).catch(error => {
            alert('Something went wrong')
            console.error('Error:', error);
        });
}