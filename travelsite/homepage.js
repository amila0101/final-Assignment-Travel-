document.addEventListener('DOMContentLoaded', function() {
    // Selecting the mobile menu toggle button and navigation links container
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    // Selecting all the navigation link items inside the menu
    const navLinkItems = document.querySelectorAll('.nav-links li a');

    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.querySelector(".mobile-menu-toggle");
        const navLinks = document.querySelector(".nav-links");

        toggleButton.addEventListener("click", () => {
            navLinks.classList.toggle("open");
        });
    });

    // Close the menu when any navigation link is clicked
    navLinkItems.forEach(link => {
        link.addEventListener('click', function() {
            // Remove the 'open' class to close the mobile menu
            navLinks.classList.remove('open');
            // Optional: Reset the hamburger button's active state
            menuToggle.classList.remove('active');
        });
    });
});

// Toggle mobile menu open/close
document.querySelector('.mobile-menu-toggle').addEventListener('click', function() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('open');
});

document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.fade-in-on-scroll');

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight)
        );
    }

    function animateOnScroll() {
        animatedElements.forEach((element) => {
            if (isInViewport(element)) {
                element.classList.add('visible');
            }
        });
    }

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
});
