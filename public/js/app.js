$(document).ready(function() {
    $('.danger-mess').hide();
    $('#decryptedMess').hide();
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

function decrypt (data) {
    var pass = "SecretPassword";
    var salt = CryptoJS.enc.Hex.parse(data.substr(0, 32));
    var iv = CryptoJS.enc.Hex.parse(data.substr(32, 32));
    var encrypted = data.substring(64);

    var key = CryptoJS.PBKDF2(pass, salt, {
        keySize: keySize/32,
        iterations: iterations
    });

    var decrypted = CryptoJS.AES.decrypt(encrypted, key, {
        iv: iv,
        padding: CryptoJS.pad.Pkcs7,
        mode: CryptoJS.mode.CBC
    });

    return decrypted;
}

function showDecryptedMessage(decryptedText) {
    var decrypted = decrypt(decryptedText);
    $('#decrypted').text( decrypted.toString(CryptoJS.enc.Utf8) );
    $('#decryptedMess').show();
}

function submitForm() {
    var password = "SecretPassword";
    var encrypted = encrypt(message, password);

    /*var message = $('#message').val();
    var visits = $('#visits').val();
    var submitMessage = false;
    var submitVisits = false;*/

    var isNumber = Number.isInteger(parseInt(visits));

    // console.log(Number.isInteger(parseInt(visits)));
    // console.log(parseInt(visits));

    /*if( $.trim(message) == '') {
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

    if( $.trim(visits) == '' || isNumber == false ) {
        $('#visitsArea').addClass('has-error');
        $('#visitsArea').removeClass('has-success');
        $('#visits').closest( 'div' ).find('.danger-mess').show();
        submitVisits = false;
    } else {
        $('#visitsArea').addClass('has-success');
        $('#visitsArea').removeClass('has-error');
        $('#visits').closest( 'div' ).find('.danger-mess').hide();
        submitVisits = true;
    }*/

    $('#messageEncoded').val(encrypted);

    // console.log(encrypted);

    /*if (submitMessage == true && submitVisits == true)*/ $('#messageForm').submit();

}