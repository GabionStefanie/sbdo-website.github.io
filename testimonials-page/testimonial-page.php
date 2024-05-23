<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Testimonials | Sulit & Bagasan Dental Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="style_testimonial.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../header-footer/header-footer.css">
</head>

<body>
    <?php include '../header-footer/header.php';
    $User_ID = 1;
    $_SESSION["User_ID"] =  $User_ID;
    ?>
    <div class="wrapper">
        <div class="title">
            <h1>TESTIMONIALS</h1>
        </div>

        <form id="testimonialForm" action="backend/testimonal.php">
            <div class="comment_form">
                <div class="card">
                    <div class="select-stars" id="star-rating-1">
                        <span onclick="setRating(1, document.getElementById('star-rating-1'))" class="star">★</span>
                        <span onclick="setRating(2, document.getElementById('star-rating-1'))" class="star">★</span>
                        <span onclick="setRating(3, document.getElementById('star-rating-1'))" class="star">★</span>
                        <span onclick="setRating(4, document.getElementById('star-rating-1'))" class="star">★</span>
                        <span onclick="setRating(5, document.getElementById('star-rating-1'))" class="star">★</span>
                    </div>

                    <br>
                    <label for="comment"></label>
                    <textarea id="comment" name="comment" placeholder="Write your comment here" required></textarea>
                    <input type="hidden" name="rating" id="rating" value="0">

                    <div id="checkbox-container">
                        <input id="anonymous" name="anonymous" type="checkbox" value="true">
                        <label for="anonymous">Review Anonymously</label>
                    </div>

                    <div class="button-container">
                        <input type="submit" value="SUBMIT" id="submit-comment">
                        <input type="reset" value="RESET" id="reset-rating-btn">
                    </div>
                </div>
            </div>
        </form>

        <div id="commentsContainer">
            <?php include 'backend/fetch_comments.php'; ?>
        </div>

    </div>
    <?php include '../header-footer/footer.php'
    ?>

    <script>
        document.getElementById("testimonialForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch('backend/testimonial.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addComment(data.comment);
                        this.reset();
                        removeSelection();
                        ratingInput.value = 0;
                        console.log(data)
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        let stars = document.getElementsByClassName("star");
        let ratingInput = document.getElementById("rating");

        function setRating(n, starContainer) {
            removeSelection(starContainer); // Pass the container to removeSelection
            for (let i = 0; i < n; i++) {
                starContainer.getElementsByClassName("star")[i].classList.add("selected");
            }
            ratingInput.value = n;
        }

        function removeSelection(starContainer) {
            const stars = starContainer.getElementsByClassName("star");
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.remove("selected");
            }
            ratingInput.value = 0;
        }

        const resetRatingBtn = document.getElementById('reset-rating-btn');
        resetRatingBtn.addEventListener('click', function() {
            removeSelection(document.getElementById('star-rating-1'));
        });

        function addComment(comment) {
            let commentsContainer = document.getElementById("commentsContainer");

            let ratingDiv = document.createElement("div");
            ratingDiv.className = "comment-rating";

            ratingDiv.className = "comment-rating";
            for (let i = 0; i < comment.rating; i++) {
                let starSpan = document.createElement("span");
                starSpan.className = "star selected_comments";
                starSpan.innerText = "★";
                ratingDiv.appendChild(starSpan);
            }

            for (let i = comment.rating; i < 5; i++) {
                let starSpan = document.createElement("span");
                starSpan.className = "star_comments";
                starSpan.innerText = "★";
                ratingDiv.appendChild(starSpan);
            }

            let commentDiv = document.createElement("div");
            commentDiv.className = "comment";

            let authorDiv = document.createElement("div");
            authorDiv.className = "comment-author";
            authorDiv.innerText = comment.anonymous;

            let dateDiv = document.createElement("div");
            dateDiv.className = "comment-date";
            dateDiv.innerText = comment.created_at;

            let textDiv = document.createElement("div");
            textDiv.className = "comment-text";
            textDiv.innerText = comment.comment;

            commentDiv.appendChild(ratingDiv);
            commentDiv.appendChild(textDiv);
            commentDiv.appendChild(authorDiv);
            commentDiv.appendChild(dateDiv);
            commentsContainer.insertBefore(commentDiv, commentsContainer.firstChild);
        }

        document.querySelector("form").addEventListener("reset", function() {
            removeSelection();
            ratingInput.value = 0;
        });
    </script>
</body>

</html>