$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  // $('.modal-trigger').leanModal();
  $('.modal-trigger').leanModal();
  $('.scrollspy').scrollSpy();
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });

  var options = [
   {selector: '#home', offset: 50, callback: function() {
     $('#home').addClass('active');
     $('#services').removeClass('active');
     $('#aboutus').removeClass('active');
     $('#contact').removeClass('active');
   } },
   {selector: '#services', offset: 205, callback: function() {
     $('li#home').removeClass('active');
     $('li#services').addClass('active');
     $('li#aboutus').removeClass('active');
     $('li#contact').removeClass('active');
   } },
   {selector: '#aboutus', offset: 400, callback: function() {
   } },
   {selector: '#contact', offset: 500, callback: function() {
   } }
  ];
  Materialize.scrollFire(options);
  $(document).ready(function() {
    $('textarea#textarea1').characterCounter();
  });
  $(document).ready(function() {
    $('select').material_select();
  });

});
