// jQuery Document Ready
$(document).ready(function() {
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });

    // Add fade-in animation to cards when page loads
    $('.card, .resume-section, .biodata-section').hide().fadeIn(800);

    // Highlight active navigation link
    var currentPage = window.location.pathname.split('/').pop() || 'index.html';
    $('.nav-menu a').each(function() {
        var linkPage = $(this).attr('href');
        if (linkPage === currentPage) {
            $(this).addClass('active');
        }
    });

    // Add hover effect to table rows
    $('.biodata-table tr').hover(
        function() {
            $(this).css('background-color', '#f8f9fa');
        },
        function() {
            $(this).css('background-color', 'transparent');
        }
    );

    // Animate skills list items on scroll
    $(window).scroll(function() {
        $('.skill-category li').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate');
            }
        });
    });

    // Simple form validation (if forms are added later)
    $('form').on('submit', function(e) {
        var isValid = true;
        $(this).find('input[required], textarea[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).css('border-color', 'red');
            } else {
                $(this).css('border-color', '');
            }
        });
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });

    // Add click animation to cards
    $('.card').on('click', function() {
        $(this).css('transform', 'scale(0.98)');
        setTimeout(() => {
            $(this).css('transform', '');
        }, 200);
    });

    // Console message
    console.log('Portfolio website loaded successfully!');
});

