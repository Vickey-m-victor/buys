(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            // Dropdown on hover for larger screens
            $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            // Dropdown on click for smaller screens
            $dropdown.off("mouseenter mouseleave");
            $dropdownToggle.off("click").on("click", function(e) {
                const $parent = $(this).parent();
                if ($parent.hasClass(showClass)) {
                    $parent.removeClass(showClass);
                    $(this).attr("aria-expanded", "false");
                    $parent.find($dropdownMenu).removeClass(showClass);
                } else {
                    // Close any other open dropdowns
                    $dropdown.removeClass(showClass);
                    $dropdown.find($dropdownToggle).attr("aria-expanded", "false");
                    $dropdownMenu.removeClass(showClass);
    
                    // Open the clicked dropdown
                    $parent.addClass(showClass);
                    $(this).attr("aria-expanded", "true");
                    $parent.find($dropdownMenu).addClass(showClass);
                }
                e.stopPropagation(); // Prevent closing dropdown on click inside
            });
        }
    });
    
    // Close dropdowns when clicking outside
    $(document).on("click", function() {
        $dropdown.removeClass(showClass);
        $dropdownToggle.attr("aria-expanded", "false");
        $dropdownMenu.removeClass(showClass);
    });
    

    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    $('.vendor-carousel').owlCarousel({
        loop: true, // Enables seamless looping
        margin: 45,
        dots: false,
        autoplay: true,
        autoplayHoverPause: false, // Ensures it doesn't stop on hover
        autoplayTimeout: 0, // Makes it continuous
        autoplaySpeed: 2000, // Smooth speed for transition
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 4
            },
            768: {
                items: 6
            },
            992: {
                items: 8
            }
        }
    });
    
    
})(jQuery);

function showMore(section) {
    const content = document.getElementById(`${section}-content`);
    const button = event.target;
    
    if (content.style.display === 'none') {
        content.style.display = 'block';
        button.textContent = 'Show Less';
        content.style.animation = 'fadeInUp 0.6s ease forwards';
    } else {
        content.style.display = 'none';
        button.textContent = 'Learn More';
    }
}

// Trigger animations when elements come into view
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    document.querySelectorAll('.animate-in').forEach((el) => observer.observe(el));
});
// Search functionality
document.getElementById('faqSearch').addEventListener('input', function(e) {
    const searchText = e.target.value.toLowerCase();
    const items = document.querySelectorAll('.accordion-item');
    
    items.forEach(item => {
        const question = item.querySelector('.accordion-button').textContent.toLowerCase();
        const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
        
        if (question.includes(searchText) || answer.includes(searchText)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

// Category filter
function filterFAQs(category) {
    const items = document.querySelectorAll('.accordion-item');
    
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// Feedback buttons
document.querySelectorAll('.feedback-btn').forEach(button => {
    button.addEventListener('click', function() {
        const feedbackSection = this.closest('.feedback-buttons');
        const wasHelpful = this.classList.contains('btn-outline-success');
        
        // Toggle active state
        feedbackSection.querySelectorAll('.feedback-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.remove('btn-success', 'btn-danger');
            btn.classList.add(btn.classList.contains('btn-outline-success') ? 'btn-outline-success' : 'btn-outline-danger');
        });
        
        this.classList.add('active');
        this.classList.remove(wasHelpful ? 'btn-outline-success' : 'btn-outline-danger');
        this.classList.add(wasHelpful ? 'btn-success' : 'btn-danger');
        
        // Here you could add code to send feedback to your server
        console.log(`Feedback recorded: ${wasHelpful ? 'Helpful' : 'Not Helpful'}`);
    });
});

/**
 * Toggle visibility of content when Learn More is clicked
 * Also changes button text between "Learn More" and "Show Less"
 */
function showMore(id) {
    const content = document.getElementById(`${id}-content`);
    const button = event.currentTarget;
    
    if (!content) {
        console.error(`Element with id ${id}-content not found`);
        return;
    }

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        button.textContent = "Show Less";
    } else {
        content.style.display = "none";
        button.textContent = "Learn More";
    }
}

// Add event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all content sections to be hidden
    ['mission', 'vision', 'values'].forEach(id => {
        const content = document.getElementById(`${id}-content`);
        if (content) {
            content.style.display = "none";
        }
    });
});
// Feedback buttons
document.querySelectorAll('.feedback-btn').forEach(button => {
    button.addEventListener('click', function() {
        const feedbackSection = this.closest('.feedback-buttons');
        const wasHelpful = this.classList.contains('btn-outline-success');
        
        // Toggle active state
        feedbackSection.querySelectorAll('.feedback-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.remove('btn-success', 'btn-danger');
            btn.classList.add(btn.classList.contains('btn-outline-success') ? 'btn-outline-success' : 'btn-outline-danger');
        });
        
        this.classList.add('active');
        this.classList.remove(wasHelpful ? 'btn-outline-success' : 'btn-outline-danger');
        this.classList.add(wasHelpful ? 'btn-success' : 'btn-danger');
        
        // Here you could add code to send feedback to your server
        console.log(`Feedback recorded: ${wasHelpful ? 'Helpful' : 'Not Helpful'}`);
    });
});