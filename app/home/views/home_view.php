<?php include 'includes/header.php'; ?>

<style>
    /* Slideshow container */
    .slideshow-container {
        position: relative;
        margin: auto;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @media only screen and (max-width: 300px) {

        .prev,
        .next,
        .text {
            font-size: 11px
        }
    }
</style>

<main>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="assets/img/slider1.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="assets/img/slider2.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="assets/img/slider3.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="assets/img/slider4.jpg" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <br>

    <div style="display: flex; flex-direction: column; width: 100%; background-color: white">
        <!-- TODO -->
    </div>
</main>

<script>
    var slideIndex = 0;
    showSlides();

    function plusSlides(n) {
        slideplus(n);
    }

    function slideplus(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex += n;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        if (slideIndex < 1) {
            slideIndex = slides.length
        }
        slides[slideIndex - 1].style.display = "block";
    }

    function showSlides() {
        slideplus(1);
        setTimeout(showSlides, 5000);
    }
</script>

<?php include 'includes/footer.php'; ?>