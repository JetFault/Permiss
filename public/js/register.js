$(function(){
  var affiliation = $('#affiliation');
  var dropdown = $('#affiliationDropdown');

  function displayForStudent(){
      affiliation.empty();
      affiliation.append($('#student-display').html());
      $('#major-add-row').click(function(){
          $('#major-div').append($('#major-div-sub-row').html());
      });
      $('#major-div').on('click','.major-sub-row', function(){
          $(this).parent().parent().remove();
      });
  }

  function displayForFaculty(){
      affiliation.empty();
  } 

  function displayAffiliation() {
      if(dropdown.val() === 'student') {
          displayForStudent();
      } else {
          displayForFaculty();
      }
  }

  displayAffiliation();
  dropdown.on('change', displayAffiliation);
});
