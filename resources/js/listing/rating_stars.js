const ratingGroup = document.querySelector('#half-stars-example .rating-group');
const ratingLabels = ratingGroup.querySelectorAll('.rating__label');

ratingLabels.forEach((label, index) => {
    label.addEventListener('mouseover', () => {
        const labelsBeforeTarget = Array.from(ratingLabels).slice(0, index + 1);
        ratingLabels.forEach(label => label.classList.remove('hovered'));
        labelsBeforeTarget.forEach(label => label.classList.add('hovered'));
    });

    ratingGroup.addEventListener('mouseout', resetShowRating);

    label.addEventListener('mousedown', handleSendRating)
});

function resetShowRating() {
    ratingLabels.forEach(label => label.classList.remove('hovered'));
}

function handleSendRating(evt) {
    let rate = evt.target.parentElement.attributes["aria-label"].nodeValue;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/listings/${listingId}/review`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            rating_value: rate
        }),
    })
        .then(response => response.text())
        .then(data => {
            let block = document.getElementById(`rating_${listingId}`)
            block.innerHTML = data;

            const labels = document.querySelectorAll('.rating__label')
            labels.forEach(function (label) {
                if (label.getAttribute('aria-label') <= rate) {
                    label.classList.add('hovered')
                }
            })

        })
        .catch(error => {
            alert('Something went wrong')
            console.error('Error:', error);
        });
}