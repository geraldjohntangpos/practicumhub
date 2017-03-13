$('#registerForm').validate({
  rules: {
    username: {
      required: true,
      minlength: 5
    }
  },
  messages: {
    username: {
      required: "Enter your username",
      minlength: "Enter atleast five characters."
    }
  },
  errorElement: 'div',
  errorPlacement: function(error, element) {
    var placement = $(element).data('error');
    if(placement) {
      $(placement).append(error)
    }
    else {
      error.insertAfter(element);
    }
  }
});
