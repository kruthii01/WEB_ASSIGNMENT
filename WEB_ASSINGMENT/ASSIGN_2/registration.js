// jQuery Document Ready
$(document).ready(function() {
    
    // Real-time validation
    $('#firstName, #lastName').on('blur', function() {
        var value = $(this).val().trim();
        var fieldName = $(this).attr('id');
        var errorId = '#' + fieldName + 'Error';
        
        if (value.length < 2) {
            $(errorId).text('Must be at least 2 characters long');
            $(this).css('border-color', '#e74c3c');
        } else {
            $(errorId).text('');
            $(this).css('border-color', '#27ae60');
        }
    });

    // Email validation
    $('#email').on('blur', function() {
        var email = $(this).val().trim();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailPattern.test(email)) {
            $('#emailError').text('Please enter a valid email address');
            $(this).css('border-color', '#e74c3c');
        } else {
            $('#emailError').text('');
            $(this).css('border-color', '#27ae60');
        }
    });

    // Phone validation
    $('#phone').on('blur', function() {
        var phone = $(this).val().trim();
        var phonePattern = /^[0-9]{10}$/;
        
        if (!phonePattern.test(phone)) {
            $('#phoneError').text('Please enter a valid 10-digit phone number');
            $(this).css('border-color', '#e74c3c');
        } else {
            $('#phoneError').text('');
            $(this).css('border-color', '#27ae60');
        }
    });

    // Pincode validation
    $('#pincode').on('blur', function() {
        var pincode = $(this).val().trim();
        var pincodePattern = /^[0-9]{6}$/;
        
        if (!pincodePattern.test(pincode)) {
            $('#pincodeError').text('Please enter a valid 6-digit pincode');
            $(this).css('border-color', '#e74c3c');
        } else {
            $('#pincodeError').text('');
            $(this).css('border-color', '#27ae60');
        }
    });

    // Date of birth validation (must be in the past)
    $('#dateOfBirth').on('change', function() {
        var selectedDate = new Date($(this).val());
        var today = new Date();
        
        if (selectedDate >= today) {
            $('#dateOfBirthError').text('Date of birth must be in the past');
            $(this).css('border-color', '#e74c3c');
        } else {
            $('#dateOfBirthError').text('');
            $(this).css('border-color', '#27ae60');
        }
    });

    // Form submission with validation
    $('#registrationForm').on('submit', function(e) {
        var isValid = true;
        
        // Clear previous errors
        $('.error-message').text('');
        $('input, select, textarea').css('border-color', '#ddd');

        // Validate required fields
        $(this).find('input[required], select[required], textarea[required]').each(function() {
            var $field = $(this);
            var value = $field.val().trim();
            var fieldName = $field.attr('name') || $field.attr('id');
            
            if ($field.attr('type') === 'checkbox') {
                if (!$field.is(':checked')) {
                    isValid = false;
                    $('#termsError').text('You must agree to the terms and conditions');
                    $field.css('outline', '2px solid #e74c3c');
                }
            } else {
                if (value === '') {
                    isValid = false;
                    var errorId = '#' + $field.attr('id') + 'Error';
                    $(errorId).text('This field is required');
                    $field.css('border-color', '#e74c3c');
                }
            }
        });

        // Validate email format
        var email = $('#email').val().trim();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailPattern.test(email)) {
            isValid = false;
            $('#emailError').text('Please enter a valid email address');
            $('#email').css('border-color', '#e74c3c');
        }

        // Validate phone format
        var phone = $('#phone').val().trim();
        var phonePattern = /^[0-9]{10}$/;
        if (phone && !phonePattern.test(phone)) {
            isValid = false;
            $('#phoneError').text('Please enter a valid 10-digit phone number');
            $('#phone').css('border-color', '#e74c3c');
        }

        // Validate pincode format
        var pincode = $('#pincode').val().trim();
        var pincodePattern = /^[0-9]{6}$/;
        if (pincode && !pincodePattern.test(pincode)) {
            isValid = false;
            $('#pincodeError').text('Please enter a valid 6-digit pincode');
            $('#pincode').css('border-color', '#e74c3c');
        }

        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            $('html, body').animate({
                scrollTop: $('.error-message:not(:empty)').first().offset().top - 100
            }, 500);
            return false;
        }

        // Prevent default form submission
        e.preventDefault();

        // Show loading state
        $('#submitBtn').addClass('loading').prop('disabled', true);
        $('#submitBtn').text('Submitting...');

        // Collect all form data
        var formData = {
            firstName: $('#firstName').val().trim(),
            lastName: $('#lastName').val().trim(),
            email: $('#email').val().trim(),
            phone: $('#phone').val().trim(),
            dateOfBirth: $('#dateOfBirth').val(),
            gender: $('#gender').val(),
            address: $('#address').val().trim(),
            city: $('#city').val().trim(),
            state: $('#state').val().trim(),
            pincode: $('#pincode').val().trim(),
            course: $('#course').val().trim(),
            interests: []
        };

        // Collect selected interests
        $('input[name="interests[]"]:checked').each(function() {
            formData.interests.push($(this).val());
        });

        // Store data in localStorage
        localStorage.setItem('registrationData', JSON.stringify(formData));

        // Redirect to results page after a short delay
        setTimeout(function() {
            window.location.href = 'registration_results.html';
        }, 500);
    });

    // Reset form handler
    $('.btn-reset').on('click', function() {
        $('.error-message').text('');
        $('input, select, textarea').css('border-color', '#ddd');
        $('#submitBtn').removeClass('loading').prop('disabled', false);
        $('#submitBtn').text('Submit Registration');
    });

    // Animate form on load
    $('.form-wrapper').hide().fadeIn(500);
    
    // Add smooth focus effect
    $('input, select, textarea').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });

    console.log('Registration form loaded successfully!');
});

