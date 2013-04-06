displayAffiliation();
document.getElementById('affiliationDropdown').onchange = displayAffiliation;

function displayAffiliation() {
    var dropdown = document.getElementById('affiliationDropdown');
    if(dropdown.value == 'Student') {
        displayForStudent();
    } else {
        displayForFaculty();
    }
}
function displayForStudent(){
    $('#affiliation').empty();
    $('#affiliation').append($('#student-display').html());
    $('#major-add-row').click(function(){
        $('#major-div').append($('#major-div-sub-row').html());
    });
    $('#major-div').on('click','.major-sub-row', function(){
        $(this).parent().parent().remove();
    });
}
function displayForFaculty(){
    $('#affiliation').empty();
} 
