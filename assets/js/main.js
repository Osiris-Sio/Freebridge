let slideIndex = 0

function showSlides() {
  const slides = document.getElementsByClassName('mySlides')
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none'
  }
  slideIndex++
  if (slideIndex > slides.length) {
    slideIndex = 1
  }
  if (slides.length > 0) {
    slides[slideIndex - 1].style.display = 'block'
  }
  setTimeout(showSlides, 2000) // Change image every 2 seconds
}

showSlides()

// Next/previous controls
window.plusSlides = function (n) {
  slideIndex += n
  showSlides()
}

// Thumbnail image controls
window.currentSlide = function (n) {
  slideIndex = n
  showSlides()
}
