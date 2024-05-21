<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Testimonials | Sulit & Bagasan Dental Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="style_testimonial.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>

<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">     
        <div class="title">
            <h1>TESTIMONIALS</h1>
        </div>

        <form id="testimonialForm" action="fetch_comments.php" method="post">
            <div class="comment_form">
                <div class="card">
                    <div class="select-stars">
                        <span onclick="setRating(1)" class="star">★</span>
                        <span onclick="setRating(2)" class="star">★</span>
                        <span onclick="setRating(3)" class="star">★</span>
                        <span onclick="setRating(4)" class="star">★</span>
                        <span onclick="setRating(5)" class="star">★</span>
                    </div>
                    <br>
                    <textarea name="comment" placeholder="Write your comment here" required></textarea>
                    <input type="hidden" name="rating" id="rating" value="0">

                    <label>
                        <input type="checkbox" name="anonymous" id="anonymousCheckbox"> Comment anonymously
                   </label>

                    <div class="button-container">
                        <input type="submit" value="SUBMIT">
                        <input type="reset" value="RESET">
                    </div>
                </div>
            </div>
        </form>

        <div id="commentsContainer">
            <?php include 'fetch_comments.php'; ?>
        </div>

    </div>
    <?php include '../header-footer/footer.php' ?>
    
    <script>
        let stars = document.getElementsByClassName("star");
        let ratingInput = document.getElementById("rating");

        function setRating(n) {
            removeSelection();
            for (let i = 0; i < n; i++) {
                stars[i].classList.add("selected");
            }
            ratingInput.value = n;
        }

        function removeSelection() {
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.remove("selected");
            }
        }

        document.getElementById("testimonialForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch('testimonial.php', {
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
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function addComment(comment) {
            let commentsContainer = document.getElementById("commentsContainer");

            let commentDiv = document.createElement("div");
            commentDiv.className = "comment";

            let ratingDiv = document.createElement("div");
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

            let authorDiv = document.createElement("div");
            authorDiv.className = "comment-author";
            authorDiv.innerText = comment.anonymous ? "Anonymous" : "User";

            let dateDiv = document.createElement("div");
            dateDiv.className = "comment-date";
            dateDiv.innerText = comment.created_at;

            let textDiv = document.createElement("div");
            textDiv.className = "comment-text";
            textDiv.innerText = comment.comment;

            commentDiv.appendChild(ratingDiv);
            commentDiv.appendChild(authorDiv);
            commentDiv.appendChild(dateDiv);
            commentDiv.appendChild(textDiv);


            commentsContainer.insertBefore(commentDiv, commentsContainer.firstChild);
        }


        // Optional: Reset stars when form is reset
        document.querySelector("form").addEventListener("reset", function () {
            removeSelection();
            ratingInput.value = 0;
        });
    </script>
</body>

</html>