var slideIndex = 0
showSlides()

function plusSlides(n) {
  slideplus(n)
}

function slideplus(n) {
  var i
  var slides = document.getElementsByClassName('mySlides')
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none'
  }
  slideIndex += n
  if (slideIndex > slides.length) {
    slideIndex = 1
  }
  if (slideIndex < 1) {
    slideIndex = slides.length
  }
  slides[slideIndex - 1].style.display = 'block'
}

function showSlides() {
  slideplus(1)
  setTimeout(showSlides, 5000)
}
