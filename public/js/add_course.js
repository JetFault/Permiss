$(function(){
  var affiliation = $('#sections');

  function displaySections(){
      affiliation.append($('#section-display').html());
      $('#section-add-row').click(function(){
          $('#section-div').append($('#section-div-sub-row').html());
      });
      $('#section-div').on('click','.section-sub-row', function(){
          $(this).parent().parent().remove();
      });
  }

  displaySections();
});
