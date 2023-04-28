
$(function () {
   
   let pusher = new Pusher($("#pusher_app_key").val(), {
        cluster: $("#pusher_cluster").val(),
        encrypted: true
    });


 $(".chat_input").on("change keyup", function (e) {
       if($(this).val() != "") {
           $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
       } else {
           $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
       }
    });
    // on click the btn send the message
   $(".btn-chat").on("click", function (e) {
       send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val());
   });
   // listen for the send event, this event will be triggered on click the send btn



function send(to_user, message)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");
    let base_url = $('#baseurl').val();
    $.ajax({
        url: base_url +"/admin/send",
        data: {to_user: to_user, message: message, _token: $("meta[name='csrf-token']").attr("content")},
        method: "POST",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.append(loaderHtml());
            }
        },
        success: function (response) {
        },
        complete: function () {
            chat_area.find(".loader").remove();
            chat_box.find(".btn-chat").prop("disabled", true);
            chat_box.find(".chat_input").val("");
            chat_area.animate({scrollTop: chat_area.offset().top + chat_area.outerHeight(true)}, 800, 'swing');
        }
    });
}

/**
 * This function called by the send event triggered from pusher to display the message
 *
 * @param message
 */
function displayMessage(message)
{
 console.log(message); 
    let alert_sound = document.getElementById("chat-alert-sound");

    if($("#current_user").val() == message.sender_id) {
 console.log('message1'); 
        let messageLine = getMessageSenderHtml(message);

        $("#chat_box_" + message.reciver_id).find(".chat-area").append(messageLine);

    } else if($("#current_user").val() == message.reciver_id) {
 console.log('message2'); 
       // alert_sound.play();

        // for the receiver user check if the chat box is already opened otherwise open it
        cloneChatBox(message.sender_id, message.fromUserName, function () {

            let chatBox = $("#chat_box_" + message.sender_id);

            if(!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                loadLatestMessages(chatBox, message.sender_id);

                chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
            } else {

                let messageLine = getMessageReceiverHtml(message);

                // append the message for the receiver user
                $("#chat_box_" + message.sender_id).find(".chat-area").append(messageLine);
            }
        });
    }
}

    // on click on any chat btn render the chat box
   $(".chat-toggle").on("click", function (e) {
       e.preventDefault();
       let ele = $(this);
       let user_id = ele.attr("data-id");
       let username = ele.attr("data-user");
         let userchanel = ele.attr("data-chanel");
       
       
        let channel = pusher.subscribe(userchanel);
        channel.bind('send', function(data) {
        displayMessage(data.data);
        });
       cloneChatBox(user_id, username, function () {

           let chatBox = $("#chat_box_" + user_id);
           // if(chatBox.length != 0){
           if(!chatBox.hasClass("chat-opened")) {

               chatBox.addClass("chat-opened").slideDown("fast");

               loadLatestMessages(chatBox, user_id);

               chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
           }
           // }else{
             // chatBox.find(".chat-area").  
           // }
       });
   });

   // on close chat close the chat box but don't remove it from the dom
   $(".close-chat").on("click", function (e) {

       $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
   });
});


/**
 * loaderHtml
 *
 * @returns {string}
 */
function loaderHtml() {
    return '<i class="glyphicon glyphicon-refresh loader"></i>';
}

/**
 * getMessageSenderHtml
 *
 * this is the message template for the sender
 *
 * @param message
 * @returns {string}
 */
function getMessageSenderHtml(message)
{
    let base_url = $('#baseurl').val();
    return `
           <div class="row msg_container base_sent" data-message-id="${message.id}">
        <div class="col-9">
            <div class="messages msg_sent text-right">
                <p>${message.message}</p>
                <time datetime="${message.dateTimeStr}"> ${message.sender_name} • ${message.dateHumanReadable} </time>
            </div>
        </div>
        <div class="col-3 avatar">
            <img src="` + base_url  +'/'+ message.user.avatar + `" width="50" height="50" class="img-responsive">
        </div>
    </div>
    `;
}

/**
 * getMessageReceiverHtml
 *
 * this is the message template for the receiver
 *
 * @param message
 * @returns {string}
 */
function getMessageReceiverHtml(message)
{
     let base_url = $('#baseurl').val();
    return `
           <div class="row msg_container base_receive" data-message-id="${message.id}">
           <div class="col-3 avatar">
             <img src="` + base_url +'/'+message.user.avatar + `" width="50" height="50" class="img-responsive">
           </div>
        <div class="col-9">
            <div class="messages msg_receive text-left">
                <p>${message.message}</p>
                <time datetime="${message.dateTimeStr}"> ${message.reciver_name}  • ${message.dateHumanReadable} </time>
            </div>
        </div>
    </div>
    `;
}


/**
 * cloneChatBox
 *
 * this helper function make a copy of the html chat box depending on receiver user
 * then append it to 'chat-overlay' div
 *
 * @param user_id
 * @param username
 * @param callback
 */
function cloneChatBox(user_id, username, callback)
{

    if($("#chat_box_" + user_id).length == 0) {
        let cloned = $("#chat_box").clone(true);
        // change cloned box id
        cloned.attr("id", "chat_box_" + user_id);

        cloned.find(".chat-user").text(username);

        cloned.find(".btn-chat").attr("data-to-user", user_id);

        cloned.find("#to_user_id").val(user_id);

        $("#chat-overlay").append(cloned);
    }

    callback();
}

/**
 * loadLatestMessages
 *
 * this function called on load to fetch the latest messages
 *
 * @param containerbase_url + "/
 * @param user_id
 */
function loadLatestMessages(container, user_id)
{
     let base_url = $('#baseurl').val();
    let chat_area = container.find(".chat-area");
    chat_area.html("");

    $.ajax({
        url: base_url+"/admin/load-latest-messages",
        data: {user_id: user_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.html(loaderHtml());
            }
        },
        success: function (response) {
            
            if(response.state == 1) {
                response.messages.map(function (val, index) {
                    $(val).appendTo(chat_area);
                });
            }
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}