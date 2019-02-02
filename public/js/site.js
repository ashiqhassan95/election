var inputs = document.querySelectorAll('.custom-file-input');
Array.prototype.forEach.call(inputs, function (input) {
    let label = input.nextElementSibling;
    let labelVal = label.innerHTML;

    input.addEventListener('change', function (e) {
        let fileName = '';
        if (this.files && this.files.length > 1)
            fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
        else
            fileName = e.target.value.split('\\').pop();

        if (fileName) {
            label.innerHTML = fileName;
        }
        else {
            label.innerHTML = labelVal;
        }
    });
});

let clearImageButton = document.querySelector('.js-clear-image-btn');
clearImageButton.addEventListener('click', function (e) {
    e.preventDefault();
    let imageInput = document.getElementById('imageInput'),
        label = imageInput.nextElementSibling;
    imageInput.value = '';
    label.innerHTML = 'Choose file...';
});