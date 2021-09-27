deleteAlert = function(action, refresh) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteAjax(action, refresh);
        }
    })
    return false;
};
deleteRecord = function(action, refresh = true) {
    deleteAlert(action, refresh = true);
}
deleteAjax = function(action, refresh) {
    axios.delete(action).then(function(response) {
        if (refresh) {
            Swal.fire('Deleted!', response.data, 'success')
            refreshDatatable();
        } else {
            window.location.reload();
        }
    }).catch(function(error) {
        console.log(error);
    })
}
refreshDatatable = function() {
    $('.dataTable').DataTable().ajax.reload();
}