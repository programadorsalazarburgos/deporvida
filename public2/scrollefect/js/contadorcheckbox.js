  $(document).ready(function(){

    var $checkboxes = $('#devel-generate-content-form input[type="checkbox"]');
        
    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        $('#count-checked-checkboxes').text(countCheckedCheckboxes);
        
        $('#edit-count-checked-checkboxes').val(countCheckedCheckboxes);
    });

});
