function hideStickerBox() {

    $('#main-chat .chat-single-box .icons').removeClass('show');
    $('#main-chat .chat-single-box .icons').find('.smiles-set').removeAttr('style');
}

function messageScroll() {

    setTimeout(function () {
        if ($('.messages div').length == 0) {
            return;
        }
        $('.message-scrooler').animate({
            scrollTop: $('.messages div:last').offset().top
        }, 0);
    }, 100);
}

$(document).on('click', '#paper-btn', function (e) {
    console.log("e", e);

    var _box_message = $('#box-messages');
    console.log("_box_message", _box_message);

    var text = $($(e.currentTarget).parent().parent().parent()).find(".input-value").val();
    console.log("text", text);

    $.ajax({
        url: _box_message.attr('url'),
        type: 'POST',
        data: {content: text},
    })
    .done(function(resp) {
        console.log("success", resp);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    



    _box_message.append('<div class="message out no-avatar media">' +
        '<div class="body media-body text-right p-l-50"><div class="content msg-reply f-12 bg-primary d-inline-block">'+ text +'</div><div class="seen"><i class="icon-clock f-12 m-r-5 txt-muted d-inline-block"></i><span><p class="d-inline-block">a few seconds ago </p></span><div class="clear"></div> </div></div>' +
        ' <div class="sender media-right friend-box"><a href="javascript:void(0);" title="Me"><img src="assets/images/avatar-1.jpg" class=" img-chat-profile" alt="Me"></a> </div>' +
        '</div>');

    hideStickerBox();
    messageScroll();

    $($(e.currentTarget).parent().parent().parent()).find(".input-value").val('');
    return false;

});