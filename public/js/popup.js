
function saveData() {
    var formData = $('#myForm').serialize();

    $.ajax({
        type: 'POST',
        url: '/save-data',
        data: formData,
        success: function (data) {
            // Handle success (e.g., close popup, show success message)
            console.log(data);
        },
        error: function (error) {
            // Handle error
            console.error(error);
        }
    });
}
