$('#userTable').DataTable({
    "paging": true
});
$('#filmTable').DataTable({
    order: [[0, 'asc']],
    columnDefs: [
        {
            targets: 0,
            render: function (data, type, row, meta) {
                if (type === 'sort') {
                    const api = new $.fn.dataTable.Api(meta.settings);
                    const tr = api.row(meta.row).node();
                    return $(tr).data('film-id');
                }
                return data;
            }
        }
    ]
});



// jQuery click handler
$('.btn-save-status').on('click', function() {
    // Get the selected status value
    const newStatus = $(this).closest('tr').find('.status-select').val();

    // Récupérez le nouvel email
    const newEmail = $(this).closest('tr').find('.email-input').val();

    // Get the user ID from the data attribute "data-user-id"
    const userId = $(this).closest('tr').data('user-id');

    console.log(newStatus + " " + newEmail + " " + userId);

    // Prepare data to be sent to the server
    const data = {
        status: newStatus,
        id: userId,
        email: newEmail
    };

    // Send AJAX PATCH request
    $.ajax({
        url: `/api/users`, // Replace with your actual API URL
        type: 'PATCH',
        contentType: 'application/json',
        data: JSON.stringify(data), // Convert the JavaScript object to a JSON string
        success: function(response) {
            console.log(response);
            location.reload();
            //alert('User status updated successfully.');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            alert('Failed to update user status.');
        }
    });
});

$('.btn-save-film').on('click', function() {
    const filmId = $(this).closest('tr').data('film-id');
    const title = $(this).closest('tr').find('.title-input').val();
    const description = $(this).closest('tr').find('.description-input').val();
    const year = $(this).closest('tr').find('.year-input').val();
    const length = $(this).closest('tr').find('.length-input').val();
    const category = $(this).closest('tr').find('.category-input').val();

    const data = {
        id: filmId,
        title: title,
        description: description,
        year: year,
        length: length,
        category: category
    };

    $.ajax({
        url: `/api/films`, // Remplacez par votre véritable URL API
        type: 'PATCH',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            console.log(response);
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            alert('Failed to update film.');
        }
    });
});



$('.btn-delete-user').on('click', function() {
    // Get the user ID from the data attribute "data-user-id"
    const userId = $(this).closest('tr').data('user-id');

    // Prepare data to be sent to the server
    const data = {
        id: userId
    };

    // Send AJAX DELETE request
    $.ajax({
        url: `/api/users`, // Replace with your actual API URL
        type: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify(data), // Convert the JavaScript object to a JSON string
        success: function(response) {
            console.log(response);
            location.reload();
            //alert('User deleted successfully.');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            alert('Failed to delete user.');
        }
    });
});

$('.btn-delete-film').on('click', function() {
    // Get the user ID from the data attribute "data-user-id"
    const filmId = $(this).closest('tr').data('film-id');

    // Prepare data to be sent to the server
    const data = {
        id: filmId
    };

    // Send AJAX DELETE request
    $.ajax({
        url: `/api/films`, // Replace with your actual API URL
        type: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify(data), // Convert the JavaScript object to a JSON string
        success: function(response) {
            console.log(response);
            location.reload();
            //alert('User deleted successfully.');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            alert('Failed to delete user.');
        }
    });
});







document.addEventListener('DOMContentLoaded', function() {

    let userTableDiv = document.getElementById('userTableDiv');
    let filmTableDiv = document.getElementById('filmTableDiv');

    let usersButton = document.getElementById('showUsers');
    let filmsButton = document.getElementById('showFilms');

    usersButton.addEventListener('click', function() {
        filmTableDiv.classList.add('hidden');
        userTableDiv.classList.remove('hidden');

        // Hide films button and show users button
        filmsButton.classList.remove('hidden');
        usersButton.classList.add('hidden');
    });

    filmsButton.addEventListener('click', function() {
        userTableDiv.classList.add('hidden');
        filmTableDiv.classList.remove('hidden');

        // Hide users button and show films button
        usersButton.classList.remove('hidden');
        filmsButton.classList.add('hidden');
    });
});