function popup(text){
    //set popupText to the <p> tag in the div
    var popupText = $('#popuptext');
    //empty the <p> tag in case of prior pop ups
    popupText.empty();
    //append new text passed through the function to the <p> tag
    popupText.append(text);
    //show when pop up is called
    const popup = $('.hover-bkgr-fricc');
    popup.show();
    //hide when the x is clicked or anywhere else on the page is clicked
    popup.click(function(){
        popup.hide();
    });
    $('.popupCloseButton').click(function(){
        popup.hide();
    });
}