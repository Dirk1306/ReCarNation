// image slider

const slides = document.querySelectorAll(".slides img");
let slideIndex = 0;
let intervalId = null;

document.addEventListener("DOMContentLoaded", initalizeSlider); 
function initalizeSlider(){
    if(slides.length > 0){
        slides[slideIndex].classList.add("displaySlide");
        intervalId = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    } 
    
}
function showSlide(index){
     
    if(index >= slides.length){
        slideIndex = 0;
    }
    else if (index < 0){
        slideIndex = slides.length - 1;
    }
    slides.forEach(slide => {
        slide.classList.remove("displaySlide");
    });

    slides[slideIndex].classList.add("displaySlide");
}
function prevSlide(){
    clearInterval(intervalId); // Stop the interval when navigating manually
    slideIndex--;
    showSlide(slideIndex);
}
function nextSlide(){
     slideIndex++;
     showSlide(slideIndex);
}