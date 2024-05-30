$(document).ready(function(){
// CALC
    function selectValue(id) {
        var sel = $(id);
    }
  	//alert('Server Wartungsarbeiten');
    //+
    var flaeche = $('#flaeche');
    var art = $('#art');
    var ecken = $('#ecken');
    var einbaustrahler = $('#einbaustrahler');
    var leuchte = $('#leuchte');
    var check = $('#check');
    var result_output = $('.result_output');
    var result_output_stern = $('.result_output_stern').children[0];
    var nalog_out = $('.nalog_out').children[0];
    var result;


    function calc() {
        var f = 0
        var a = 0
        f = $('#flaeche').val().replace(',','.');
        $('#art option').each(function(){
            if($(this).prop('selected') === true) {
                a = $(this).val()
            }
        })
        var e;
        var s = $('#einbaustrahler').val();
        var l = $('#leuchte').val();
        var faktor;
        var n;
        var qmp;
        f = +f
        a = +a
        s = +s
        l = +l
       
        f < 3 ?  faktor = 1.08 : faktor = 3/Math.pow(f,(0.8))-0.17;
        +$('#ecken').val() < 5 ? e = 0 : e = +$('#ecken').val() - 4;
        if(a==42.60)qmp=42.00;
        if(a==52.15)qmp=52.00;
        if(a==71.15)qmp=71.00;
        f == 1 ? result = Math.round(qmp + 21.08*e + 29.41*s + 50.42*l) : result = Math.round(a*f*(1 + faktor) + 21.08*e + 29.41*s + 50.42*l);
        
        if($('#check').prop('checked') === true) {
            n = Math.round(result*100)/100
        } else {
            n = 0
        }
        
        
    }
    function checkFloatSymbol(n){ 
        return ((+n>=0 || +n<=9  || n=='.' || n==',') && n!=' ' && !isNaN($('#flaeche').val().replace(',','.'))) ? true : false;
    }
    function checkIntSymbol(n){ 
        return ((+n>=0 || +n<=9) && n!=' ') ? true : false;
    }
  
    function update_res() { 
        calc();  
        
        var lang = $('html').attr('lang')
        var totalText = 'Gesamtpreis'
        var currencyText = 'Euro'
        
        var nettoText = 'Nettopreis (für B2B)'
        var ndsText = 'Umsatzsteuer(19%)'
        var bruttoText = 'Bruttopreis'
        if (lang === 'ru') {
            totalText = 'Итого'
            currencyText = 'Евро'
            nettoText = 'Нетто (для B2B)'
            ndsText = 'НДС (19%)'
            bruttoText = 'Брутто'
        }
        
        result.toString().length > 3 ? $('.result_output').html( totalText + ": " + result.toString().slice(0,-3) + '.' + result.toString().slice(-3) + ",00 " + currencyText) : $('.result_output').html(totalText + ": " + result + ",00 " + currencyText);
    
        $('#flaeche').val().replace(',','.')==1 ? $('.result_output_stern').html("*") : $('.result_output_stern').html("");
    

        $('.nalog_out').html(nettoText + ": " + result + "€ <br />"+ndsText+": " + Math.round(result*0.19*100)/100 + "€ <br />"+bruttoText+": " + Math.round(result*1.19*100)/100 + '€')
    }
    
    $('#check').on('change', function(){
        if($(this).prop('checked') === true) {
            $('.nalog_out').show()
        } else {
            $('.nalog_out').hide()
        }
    })
  
    function setFokusStyle(elem){
        elem.style.background = '#ffff99';
    }
    function unsetFokusStyle(elem){
        elem.style.background = '#fff';
    }
  
  $('#flaeche').on('focus', function(e) { 
    var elem = e.target;
    setFokusStyle(elem);
    elem.value = '';
    var str = elem.value;
    $('#flaeche').on('input', function(e) {
        var symbol = e.target.value[e.target.value.length-1];
      
        if (e.target.value==='' || e.target.value=='0') {
            str='';
            return;
        }
        if(symbol===','){ 
            symbol='.';		
        }
        checkFloatSymbol(symbol) ? str = elem.value : elem.value = str;
        update_res();
    });
  });
  $('#flaeche').on('blur', function(e) { 
        unsetFokusStyle(e.target);
        if (e.target.value==='') {
            e.target.value = 0;
            flaeche.value = +0;
        }
      update_res();  
  });
  
    $('#ecken').on('focus', function(e) { 
        var elem = e.target;
        setFokusStyle(elem);
        elem.value = '';
        var str = elem.value;
        $('#ecken').on('input', function(e) {
            var symbol = e.target.value[e.target.value.length-1];
      
            if (e.target.value==='' || e.target.value==='0') {
                str='';
                return;
            }
            checkIntSymbol(symbol) ? str = elem.value : elem.value = str;
            update_res();
        });
    });
    $('#ecken').on('blur', function(e) {
        unsetFokusStyle(e.target);
        if (e.target.value==='') {
            e.target.value = 0;
            ecken.value = +0;
        }
        update_res();  
    });
  
    $('#einbaustrahler').on('focus', function(e) { 
        var elem = e.target;
        setFokusStyle(elem);
        elem.value = '';
        var str = elem.value;
        $('#einbaustrahler').on('input', function(e) {
            var symbol = e.target.value[e.target.value.length-1];
      
            if (e.target.value==='' || e.target.value==='0') {
                str='';
                return;
            }
            checkIntSymbol(symbol) ? str = elem.value : elem.value = str;
            update_res();
        });
    });
    $('#einbaustrahler').on('blur', function(e) {
        unsetFokusStyle(e.target);
        if (e.target.value==='') {
            e.target.value = 0;
            einbaustrahler.value = +0;
        }
        update_res();  
    });
  
    $('#leuchte').on('focus', function(e) { 
        var elem = e.target;
        setFokusStyle(elem);
        elem.value = '';
        var str = elem.value;
        $('#leuchte').on('input', function(e) {
            var symbol = e.target.value[e.target.value.length-1];
      
            if (e.target.value==='' || e.target.value==='0') {
                str='';
                return;
            }
            checkIntSymbol(symbol) ? str = elem.value : elem.value = str;
            update_res();
        });
    });
    $('#leuchte').on('blur', function(e) {
        unsetFokusStyle(e.target);
        if (e.target.value==='') {
            e.target.value = 0;
            leuchte.value = +0;
        }
        update_res();  
    });
    $('#art').on('change', function(){
        update_res()
    })
});