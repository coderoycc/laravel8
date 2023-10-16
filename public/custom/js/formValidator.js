function validator(idButton, idForm){
  $(`#${idForm} :input, form select`).on('input change', function(e) {
    var classes = Array.from(e.target.classList);
    if(classes.includes('form-number')){
      validator_number(e.target);
    }else if(classes.includes('form-email')){
      validator_email(e.target);
    }else if(classes.includes('form-cad-3')){
      validator_cad(e.target, 3);
    } else if(classes.includes('form-movil-phone')) {
      validator_movil_phone(e.target);
    } else if(classes.includes('form-today')){
      validator_date_today(e.target);
    }

    
    var form = $(`#${idForm}`);
    var isFormValid = true;
    form.find(`:input[required], form select[required]`).each(function() {
      if ($(this).val() === '') {
        isFormValid = false;
        return false; 
      }
    });
    if(form.find('.is-invalid').length > 0){
      isFormValid = false;
    }
    if (isFormValid) {
      // console.log('valido')
      $(`#${idButton}`).prop('disabled', false);
    } else {
      $(`#${idButton}`).prop('disabled', true);
    }
  });
}

function validator_number(e){
  if($.isNumeric(e.value)){
    $(e).removeClass('is-invalid');
  }else{
    $(e).addClass('is-invalid');
  }
}

function validator_email(e){
  const pattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
  if(pattern.test(e.value)){
    $(e).removeClass('is-invalid');
  }else{
    $(e).addClass('is-invalid');
  }
}

// validador para que la fecha sea mayor a hoy
function validator_date_today(e){
  const today = new Date();
  let current = new Date(e.value);
  if(current.getTime() > today.getTime()){
    $(e).removeClass('is-invalid');
  }else{
    $(e).addClass('is-invalid');
  }
}

function validator_movil_phone(e){
  if($.isNumeric(e.value) && (e.value.startsWith('6') || e.value.startsWith('7') || e.value.startsWith('2'))){
    if(e.value.length == 8){
      $(e).removeClass('is-invalid');
    }else{
      $(e).addClass('is-invalid');
    }
  }else{
    $(e).addClass('is-invalid');
  }
}
function validator_cad(e, max){
  if(e.value.length < max){
    $(e).addClass('is-invalid');
  }else{
    $(e).removeClass('is-invalid');
  }
}
function validator_age_range(min, max){
  const today = new Date();
  var year = today.getFullYear();
  var month = today.getMonth();
  var day = today.getDate();
  $('.form-age').on('input change', function(e) {
    const dateTarget = new Date(e.target.value);
    var yearTarget = dateTarget.getFullYear();
    var monthTarget = dateTarget.getMonth();
    var dayTarget = dateTarget.getDate() + 1;
  
    var diff = year - yearTarget;
    if (month < monthTarget) {
      diff--;
    } else if (month == monthTarget && day < dayTarget) {
      diff--;
    }

    if(diff < max && diff > min){
      $(e.target).removeClass('is-invalid');
    }else{
      $(e.target).addClass('is-invalid');
    }
  })
}