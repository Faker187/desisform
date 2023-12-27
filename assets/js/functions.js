$(document).ready(function(){

  /* FORMATEAR RUT CHILENO */
  $("#input_rut").focusout(function(){
    var div1, div2, div3, div4;
    rut=$(this).val();

    if(rut.length==9){    
        div1=rut.slice(0,2);
        div2=rut.slice(2,5);
        div3=rut.slice(5,8);
        div4=rut.slice(8,9);

        rut=$(this).val(div1 + "." + div2 + "." + div3 + "-" + div4);
    }

    if(rut.length==8){    
        div1=rut.slice(0,1);
        div2=rut.slice(1,4);
        div3=rut.slice(4,7);
        div4=rut.slice(7,8);

        rut=$(this).val(div1 + "." + div2 + "." + div3 + "-" + div4);
    }
  });


  /* SUBMIT DE FORMULARIO */
  $('#form_vote').on('submit', function(e){
    e.preventDefault();

    const data = $(this).serialize();

    $('#btn-submit').attr('disabled',true);
    $('#btn-submit').addClass('disabled');

    /* Validar Rut */
    if(!ValidateRut($('#input_rut').val())){
      $('#btn-submit').removeAttr('disabled'); 
      $('#btn-submit').removeClass('disabled');
      return alertify.error('Rut incorrecto');
    } 

    /* Validar campos en blanco */
    if(!$('#select_region').val() || !$('#select_comuna').val() || !$('#input_name').val() || !$('#select_candidato').val()){
      $('#btn-submit').removeAttr('disabled'); 
      $('#btn-submit').removeClass('disabled');
      return alertify.error('Los campos Región, Comuna, Candidato, Nombre y Apellido son obligatorios');
    }

    /* validar cantidad de checked */
    if($('input[name="comoseentero[]"]:checked').length < 2){
      $('#btn-submit').removeAttr('disabled'); 
      $('#btn-submit').removeClass('disabled');
      return alertify.error('Debes elegir al menos dos opciones');
    }

    /* Validar voto por Rut */
    $.ajax({
      type: 'POST',
      data: {'rut':$('#input_rut').val()},
      url: 'back/AjaxValidateVoteByRut.php',
      async: false,
      success: function(response){
        if( response == 1){
          $('#btn-submit').removeAttr('disabled'); 
          $('#btn-submit').removeClass('disabled');
          return alertify.error(`Ya existe un voto con el RUT: ${ $('#input_rut').val() }`);
        }else if(response == 2){

          /* Votar */
          $.ajax({
            type: 'POST',
            data: data,
            url: 'back/AjaxVote.php',
            async: false,
            success: function(data){
              if(data){
                alertify.success(data);
                setTimeout(() => {
                  location.reload();
                }, 3000);
              }
            },
            error: function(error){
              console.log(error);
            }
          });
        }
      },
      error: function(error){
        console.log(error);
      }
    });

  });
  
});

/* VALIDACION DE ALIAS */
const OnValidateNumbersLetters = (arg) => {
  const re = /^[a-z0-9ñ]*$/i;
  const match = arg.match(re) !== null;
  if(arg.length > 5){
    if(!match){
      $('#btn-submit').attr('disabled',true);
      $('#btn-submit').addClass('disabled');
      return $('#validacion_alias').text('Solo numeros y letras');
    }else
      $('#btn-submit').removeAttr('disabled'); 
      $('#btn-submit').removeClass('disabled');
      return $('#validacion_alias').text('');
  }else{
    $('#btn-submit').attr('disabled',true);
    $('#btn-submit').addClass('disabled');
    return $('#validacion_alias').text('El Alias debe contener mas de 5 caracteres.');
  }
}

/* BUSCAR COMUNAS POR REGION */
const OnSearchCommunesByRegion = (arg) => {
  $.ajax({
    type: 'POST',
    url: 'back/AjaxSearchCommunesByRegion.php',
    data: {arg},
    dataType: 'JSON',
    success: function(response){
      $("#select_comuna").empty();
      $.each(response, function(i, val) {
        $("#select_comuna").append($('<option>', {
          value: val[0],
          text: val[1]
        }));
      });
      
    },
    error: function(error){
      console.log(error);
    }
  });
}

/* VALIDADOR DE RUT */
const ValidateRut = (arg) => {
  const regex = /^(\d{1,2}\.?\d{3}\.?\d{3})\-?([\dkK])$/;
  
  if(!regex.test(arg)){
    return false; 
  }

  const rut = arg.replace(/\./g, '');
  const [numero, digitoVerificador] = rut.split('-');
  const dvCalculado = CalculateDigitChecker(numero);
  
  return dvCalculado === digitoVerificador.toUpperCase();
}
const CalculateDigitChecker = (arg) =>{
  let sum = 0;
  let mult = 2;
  for (let i = arg.length - 1; i >= 0; i--) {
    sum += parseInt(arg.charAt(i)) * mult;

    mult = mult === 7 ? 2 : mult + 1;
  }
  const resto = sum % 11;
  const dv = 11 - resto;
  return dv === 11 ? '0' : dv === 10 ? 'K' : dv.toString();
}
