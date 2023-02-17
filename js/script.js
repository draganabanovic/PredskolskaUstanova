//automatsko zatvaranje alert-a
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1300);

function proveraOpisaKonkursa(){
    if (!$('#opis').val()) {
        alert('Uneti opis konkursa');
        return false;
    }
    return true;
}

var greska=false;
//Validacija forme za prijavu deteta
function proveraForme(){
    greska=false;
    var ime = $('#imePrijava');
    var prezime = $('#prezimePrijava');
    var jmbg = $('#jmbgPrijava');
    var datum = $('#datumPrijava');
    var adresa = $('#adresaPrijava');
    var mesto = $('#mestoPrijava');
    var drzavljansrvo = $('#drzavljansrvoPrijava');
    var drustvenaGrupa = $('#drustvenaGrupaPrijava');
    var zdravstvenaStanja = $('#zdravstvenaStanjaPrijava');
    var konkurs = $('#konkursPrijava');
    

    var imeError = $('#imePrijavaError');
    var prezimeError = $('#prezimePrijavaError');
    var jmbgError = $('#jmbgPrijavaError');
    var datumError = $('#datumPrijavaError');
    var adresaError = $('#adresaPrijavaError');
    var mestoError = $('#mestoPrijavaError');
    var drzavljansrvoError = $('#drzavljansrvoPrijavaError');
    var drustvenaGrupaError = $('#drustvenaGrupaPrijavaError');
    var zdravstvenaStanjaError = $('#zdravstvenaStanjaPrijavaError');
    var konkursError = $('#konkursPrijavaError');
    
    var input = [ime,prezime,jmbg,datum,adresa,mesto,drzavljansrvo,drustvenaGrupa,zdravstvenaStanja,konkurs];

    var inputError = [imeError,prezimeError,jmbgError,datumError,adresaError,mestoError,drzavljansrvoError,drustvenaGrupaError,zdravstvenaStanjaError,konkursError];

    proveraGreske(input,inputError);

    if(jmbg.val().toString().length !=13){
        jmbgError.css("display", "block");
        jmbg.addClass("errorInput");
        greska= true;
    }else{
        jmbgError.css("display", "none");
        jmbg.removeClass("errorInput");
    }

    

    if(greska){
        return false;
    }
    return true;
   
}

function proveraGreske(input, inputError){
    
    for(let i = 0; i < input.length; i++){
        if(input[i].val()=="" || input[i].val()==undefined){
            inputError[i].css("display", "block");
            input[i].addClass("errorInput");
            greska= true;
        }else{
            inputError[i].css("display", "none");
            input[i].removeClass("errorInput");
        }
    }
}

function proveraJMBG(){
    var jmbg =$('#jmbg');
    var jmbgError =$('#jmbgError');
 
    if(jmbg.val()=='' || jmbg.val().toString().length !=13){
        jmbgError.css("display", "block");
        return false;
    }
    jmbgError.css("display", "none");
    return true;
}

function proveraJMBGIzvestaj(){
    var jmbg =$('#jmbgIzvestaj');
    var jmbgError =$('#jmbgIzvestajError');
 
    if(jmbg.val()=='' || jmbg.val().toString().length !=13){
        jmbgError.css("display", "block");
        return false;
    }
    jmbgError.css("display", "none");
    return true;
}
