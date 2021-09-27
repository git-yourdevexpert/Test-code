(function($) {

    openModalPopup = function (obj,lable="") {
        $("#defaultModalLabel").text(lable);
        $("#defaultModalLabel").text(lable);
        $($(obj).data("target")).modal("show");
        $($(obj).data("target")+' .modal-body').load($(obj).data("remote"));
    }
    populateUserList = function(url){
    $(".uid").select2({
      ajax: {
          url: url,
          dataType: 'json',
          delay: 250,
          data: function(params) {
              return {
                  q: params.term, // search term
                  page: params.page
              };
          },
          processResults: function(data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;
              return {
                  results: data.data,
                  pagination: {
                      more: (data.next_page_url != null) ? true : false
                  }
              };
          },
          cache: true
      },
      placeholder: 'Search for a user',
      minimumInputLength: 1
  });
}
}(jQuery));
