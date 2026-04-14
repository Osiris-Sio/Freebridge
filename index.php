<?php
include 'includes/header.php'; ?>
<style>
/* Slideshow container */
.slideshow-container {
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
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

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}


.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>

<main class="mdl-layout__content" style="background-color: white;margin: 2% 0%">
    <div>
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
        <div style="display: flex; flex-direction: column;width: 100%; background-color: white">
		
          		<!--	
            <img id="separation" src="assets/img/separation.jpg" style="order: 2;">
            <div id="focus" style="order: 3;display: flex; flex-direction: row;">
                <div style="order:1; margin-right: auto; width: 40%">
                    <img class="lvlfocus" src="assets/img/focus.jpg">
                </div>
                <div style="order:2; width: 50% ">
                    <h3 style="font-family: 'Gotham Bold'">TELECHARGEMENT DU LOGICIEL DE LECTURE DES DONNES</h3>
					<p> style="font-family: 'Gotham'; font-size: 20px">Ce logiciel permet une fois installé sur votre ordinateur la lecture des donnes proposées par le site<br> </p>
                        
					<p><a href="bbo_setup.exe">Téléchargement Logiciel de Lecture </a> 
					
					<p><a href="Utilisation du mode Lecture.pdf" target="_blank">Utilisation du mode Lecture</a> 
                </div>
            </div>
			-->
			
        </div>
    </div>
</main>


<script>
var slideIndex = 0;
showSlides();

function plusSlides(n) {
  slideplus();
}

function slideplus(){
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
}

function showSlides() {
  slideplus();
  setTimeout(showSlides, 5000);
}
</script>
<?php include 'includes/footer1.php';
?>
