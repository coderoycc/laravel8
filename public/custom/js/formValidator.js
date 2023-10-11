function validator(idButton, idForm){
  $(`#${idForm} :input, form select`).on('input change', function(e) {
    var classes = Array.from(e.target.classList);
    if(classes.includes('form-number')){
      validator_number(e.target);
    }else if(classes.includes('form-email')){
      validator_email(e.target);
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
      console.log('valido')
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

}

function validator_movil_phone(){

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