document.addEventListener("click", function (element) {

    let closestButton = element.target.closest("button");

    if (closestButton.dataset.postlike != 'undefined') {

        let postToLike = closestButton.dataset.postlike;
        fetch("controller-like.php?post=" + postToLike)
            .then((response) => response.text())
            .then((data) => {

                if (data == "liked") {
                    closestButton.innerHTML =
                        `<button data-postlike="` + postToLike + `">
                    <i class="fa-solid fa-heart"></i>
                        </button>`;
                    document.getElementById('likespost' + postToLike).innerHTML = parseInt(document.getElementById('likespost' + postToLike).innerHTML) + 1

                } else if (data == "unliked") {

                    closestButton.innerHTML =
                        `<button data-postlike="` + postToLike + `">
                    <i class="fa-regular fa-heart"></i>
                        </button>`;
                    document.getElementById('likespost' + postToLike).innerHTML = parseInt(document.getElementById('likespost' + postToLike).innerHTML) - 1

                }
            });
    }

});



