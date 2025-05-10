document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 1;
    const totalSteps = 3;

    const initialProgress = 3;
    document.getElementById("progressBar").style.width = `${initialProgress}%`;

    function showStep(step) {
        document.querySelectorAll(".form-step").forEach((el, index) => {
            if (index + 1 === step) {
                el.style.display = "flex";  
            } else {
                el.style.display = "none";  
            }
        });


        const progress = initialProgress + ((step - 1) / (totalSteps - 1)) * (100 - initialProgress);
        document.getElementById("progressBar").style.width = `${progress}%`;
    }

    document.querySelectorAll(".next").forEach(button => {
        button.addEventListener("click", function () {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll(".prev").forEach(button => {
        button.addEventListener("click", function () {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    showStep(currentStep);
});

AOS.init();
particlesJS("particles-js", {
    "particles": {
        "number": {
            "value": 80,
            "density": {
                "enable": true,
                "value_area": 800
            }
        },
        "color": {
            "value": "#333333"
        },
        "shape": {
            "type": "circle",
            "stroke": {
                "width": 0,
                "color": "#333333"
            },
            "polygon": {
                "nb_sides": 5
            },
            "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
            }
        },
        "opacity": {
            "value": 0.3,
            "random": false,
            "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
            }
        },
        "size": {
            "value": 3,
            "random": true,
            "anim": {
                "enable": false,
                "speed": 40,
                "size_min": 0.1,
                "sync": false
            }
        },
        "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#333333",
            "opacity": 0.4,
            "width": 1
        },
        "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
                "enable": false,
                "rotateX": 600,
                "rotateY": 1200
            }
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
            "onhover": {
                "enable": true,
                "mode": "grab"
            },
            "onclick": {
                "enable": true,
                "mode": "push"
            },
            "resize": true
        },
        "modes": {
            "grab": {
                "distance": 140,
                "line_linked": {
                    "opacity": 1
                }
            },
            "bubble": {
                "distance": 400,
                "size": 40,
                "duration": 2,
                "opacity": 8,
                "speed": 3
            },
            "repulse": {
                "distance": 200,
                "duration": 0.4
            },
            "push": {
                "particles_nb": 4
            },
            "remove": {
                "particles_nb": 2
            }
        }
    },
    "retina_detect": true
});
// Function to animate the counter
const counters = document.querySelectorAll('.counter');

const animateCounter = (counter) => {
    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const currentValue = +counter.innerText;
        
        const increment = target / 200; // Adjust the speed of the increment here
        
        if (currentValue < target) {
            counter.innerText = Math.ceil(currentValue + increment);
            setTimeout(updateCounter, 200); // Control animation speed
        } else {
            counter.innerText = target;
        }
    };

    updateCounter();
};

// Wait for the window to load before starting the animation
window.addEventListener('load', () => {
    counters.forEach(counter => {
        animateCounter(counter);
    });
});