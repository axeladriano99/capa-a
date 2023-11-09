$(document).ready(function() {

    $('.edit-info').hide();

    $('#edit-btn-basics').on('click', function() {
        showHideEdit($(this), '#view-info-basics', '#edit-info-basics');
    });

    $('#edit-btn-financial').on('click', function() {
        showHideEdit($(this), '#view-info-financial', '#edit-info-financial');
    });

    var showEdFinancial = $('#edit-info-financial').attr('show');
    console.log("showEdFinancial", showEdFinancial);
    if(showEdFinancial == 'yes'){
        showHideEdit($('#edit-btn-financial'), '#view-info-financial', '#edit-info-financial');
    }

    function showHideEdit(btn, idView, idEdit) {
        var b = btn.find("i");
        var edit_class = b.attr('class');
        if (edit_class == 'icofont icofont-edit') {
            b.removeClass('icofont-edit');
            b.addClass('icofont-close');
            $(idView).hide();
            $(idEdit).show();
        } else {
            b.removeClass('icofont-close');
            b.addClass('icofont-edit');
            $(idView).show();
            $(idEdit).hide();
        }
    }
});