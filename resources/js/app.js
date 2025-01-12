const showFormArticle = document.querySelectorAll('.showFormArticle');
const formArticle = document.querySelectorAll('.formArticle');

const showInputImage = document.querySelectorAll('.showInputImage');
const inputImage = document.querySelectorAll('.inputImage');

const showInputTags = document.querySelectorAll('.showInputTags');
const inputTags = document.querySelectorAll('.inputTags');

const showPopupUser = document.querySelectorAll('.showPopupUser');
const popupUser = document.querySelector('.popupUser');

const showActions = document.querySelectorAll('.showActions');
const popupActions = document.querySelectorAll('.popupActions');

const showpopupSort = document.querySelector('.showpopupSort');
const popupSort = document.querySelector('.popupSort');


const closeForm = document.querySelectorAll('.closeForm');

// show form article
showFormArticle.forEach(show => {
    show.addEventListener('click', () => {
        formArticle.forEach(form => {
            form.classList.remove('hidden');

        })
    })
})

// show input upload image in form article
showInputImage.forEach((show, i) => {
    show.addEventListener('click', () => {
        
        inputImage[i].classList.toggle('hidden');
    })
})

// show input tags in form article
showInputTags.forEach((show, i) => {
    show.addEventListener('click', () => {
        inputTags[i].classList.toggle('hidden');
    })
})

showPopupUser.forEach(show => {
    show.addEventListener('click', () => {
        popupUser.classList.toggle('hidden')
    })
})

// show form actions
showActions.forEach(show => {
    show.addEventListener('click', () => {
        let idArticle = show.dataset.id;
        
        popupActions.forEach(popup => {
            let idPopUp = popup.dataset.id;

            if (idPopUp === idArticle) {
                popup.classList.toggle('hidden')
            } else {
                popup.classList.add('hidden')
            }
        })
    })
})

showpopupSort.addEventListener('click', () => {
    popupSort.classList.toggle('hidden');
})

// close article
closeForm.forEach(close => {
    close.addEventListener('click', () => {
        window.location.href = "/resources/views/blog/blog.php"
    })
})