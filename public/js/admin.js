//image preview

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});



// delete confirm

function deleteconfig() {
    var result = confirm("Delete!! Are you sure?");
    if (result) {
        return true;
    }
    return false;
}

//check if checkbox item is empty
function checkselected() {

    if($('input[name="checked[]"]:checked').length < 1){
        $.alert({
            theme: 'material',
            type: 'red',
            typeAnimated: true,
            title: 'Error!!',
            content: 'No item selected. Please select at least one item..',
        });
        return false;
    }
    return true;
}

