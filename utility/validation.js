$(document).ready(function() {

     $('form').on('submit', function(event) {
        const { username, password, repeatPassword, phone, email } = Object.fromEntries(new FormData(this));

        try {
            validateField(username, '#username', 'Username must be at least 3 characters long.');
            validateField(password, '#password', 'Password must be at least 8 characters long.');
            validateField(email, '#email','Invalid email format. You are email muse be like: example@abv.bg.');
            validateField(phone, '#phone', 'Invalid phone format. You are phone number must be like: +359 XX XXX XXX');
            
            if (!repeatPassword || password !== repeatPassword) {

                alertNotifaction(  $('#repeatPassword'), "Passwords do not match.")
            }

            if ($('.border-danger').length > 0) {
                throw new Error('Invalid format');
            }
        } catch (error) {
            console.error(error);
            event.preventDefault();
        }
    });

    function validateField(input, selector, errorMessage) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        const phoneRegex = /^(\+359|0)[0-9]{9}$/;

        if (selector === '#username' && (input === undefined || input.length < 3)) {
            alertNotifaction(selector, errorMessage);
        }
        
        if (selector === '#password' && (input === undefined || input.length < 8)) {
            alertNotifaction(selector, errorMessage);
        }
        if (selector === '#email' && (input === undefined || !emailRegex.test(input))) {
            alertNotifaction(selector, errorMessage);
        }

        if(selector === '#phone' && ( input === undefined || !phoneRegex.test(input))){
            alertNotifaction(selector, errorMessage);
        }

    }

    function alertNotifaction(selector, errorMessage){
        const $inputField = $(selector);

        // Check if the error message doesn't already exist, then append it
        if (!$inputField.next('.error-message').length) {
            $inputField.addClass('border-danger');
            $inputField.after('<p class="error-message" style="color:red;">' + errorMessage + '</p>');
            }
    }
    
    // Remove border-danger and error message on focus
    $('form input').on('focus', function() {
        $(this).removeClass('border-danger');
        $(this).next('.error-message').remove();
    });

});
