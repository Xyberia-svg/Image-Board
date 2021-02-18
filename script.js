$("#replyForm").on('submit', function (e) {
    e.preventDefault();
    $.ajax(
        {
            'type': 'POST',
            'dataType': 'JSON',
            'url': './AjaxRequests.php',
            'processData': false,
            'contentType': false,
            'cache': false,
            'data': new FormData(this),

            // beforeSend: function(){
            //     $('button').attr("disabled", "disabled")
            // },
            'success': function (response) {
                $('#upInfo').empty();
                if (response !== false) {
                    if (response.status === 2) {
                        $('#upInfo').css("color", "green");
                        $('#upInfo').append(response.message);
                        $('#noCmnt').empty();
                        $('#noCmnt').removeAttr('class');
                        if (!$('#user').val() || $('#user').val().length === 0) {
                            response.infos[0] = 'Anonymous';
                        }
                        // DOM MANIPULATION
                        commentHTML = '<div style="border-radius:4px" class="card border-primary mb-3 mt-3">' +
                            '<div id = "userPlace" class="card-header" style = "font-size:20px">'
                            + response.infos[0] + ' <span style="font-size:15px;"> replied</span> <span style="float:right;font-size:small;padding-top:7px;display:block"">'
                            + response.infos[2].upDate + '</span> </div>' +
                            '<div class="card-body"><p id="commentPlace" class="card-text">' + response.infos[1] + '</p></div><img style="display:block;margin:auto;margin-top:30px;border-radius:4px" class="mb-5"width ="650"src="/Personal projects/Image Board Application/upload/'
                            + response.infos[2].imgName + '" ></div>'

                        $('#comments').append(commentHTML);
                    } else {
                        $('#upInfo').css("color", "red");
                        $('#upInfo').append(response.message);
                    }
                }

                // $('img').attr("src", "/Personal projects/Image Board Application/upload/" + response.infos[2].imgName);
                // $('img').attr("width","500");

            },

        }
    )
}
)
