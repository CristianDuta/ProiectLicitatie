(function ($) {
    $(document).ready(function () {
        var auctionList = [];
        var sendAuctionsViaEmailForm = $("form[name=sendAuctionsViaEmail]");

        sendAuctionsViaEmailForm.find("a.sendAuctionsViaEmailButton").click(function() {
            $(".sendAuctionViaEmailPanelLoading, .sendAuctionViaEmailPanel").toggle();
            $.ajax({
                type: "POST",
                url: "/admin/sendAuctionViaEmail",
                data: {
                    emailSubject : sendAuctionsViaEmailForm.find('input[name=emailSubject]').val(),
                    emailList : sendAuctionsViaEmailForm.find('input[name=emailList]').val(),
                    auctionList: auctionList
                },
                success: function(response){
                    if (response.statusMessage != 'success') {
                        $(".sendAuctionViaEmailPanelLoading, .sendAuctionViaEmailPanel").toggle();
                        alert(response.statusMessage);
                    } else {
                        alert("Mesaj trimis cu success!");
                        location.reload();
                    }
                }
            });
        });
        $(document).on('ifChecked', ".sendViaEmailGroup input[type=checkbox].addToSendViaEmailList", function() {
            auctionList.push($(this).parents('.sendViaEmailGroup').find('input[type=hidden][name=auctionId]').val());
            $('.sendAuctionViaEmailPanel').show();
            $(".selectedAuctionsNumber").html(auctionList.length);
        });
        $(document).on('ifUnchecked', ".sendViaEmailGroup input[type=checkbox].addToSendViaEmailList", function() {
            var index = auctionList.indexOf($(this).parents('.sendViaEmailGroup').find('input[type=hidden][name=auctionId]').val());
            if (index > -1) {
                auctionList.splice(index, 1);
            }
            $(".selectedAuctionsNumber").html(auctionList.length);
        });
    });
})(jQuery);