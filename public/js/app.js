$(document).ready(function() {
    $('.danger-mess').hide();
});

var keySize = 256;
var ivSize = 128;
var iterations = 100;

function encrypt (msg, pass) {
    var salt = CryptoJS.lib.WordArray.random(128/8);

    var key = CryptoJS.PBKDF2(pass, salt, {
        keySize: keySize/32,
        iterations: iterations
    });

    var iv = CryptoJS.lib.WordArray.random(128/8);

    var encrypted = CryptoJS.AES.encrypt(msg, key, {
        iv: iv,
        padding: CryptoJS.pad.Pkcs7,
        mode: CryptoJS.mode.CBC

    });

    var transitmessage = salt.toString()+ iv.toString() + encrypted.toString();

    return transitmessage;
}

function submitForm() {
    var message = $('#message').val();
    var submitMessage = false;
    var password = "SecretPassword";
    var encrypted = encrypt(message, password);

    if( $.trim(message) == '') {
        $('#messArea').addClass('has-error');
        $('#messArea').removeClass('has-success');
        $('#message').closest( 'div' ).find('.danger-mess').show();
        submitMessage = false;
    }
    else {
        $('#messArea').addClass('has-success');
        $('#messArea').removeClass('has-error');
        $('#message').closest( 'div' ).find('.danger-mess').hide();
        submitMessage = true;
    }

    $('#messageEncoded').val(encrypted);

    // console.log(encrypted);

    if (submitMessage == true) $('#messageForm').submit();

}