'use strict';

var onoff = true;
var _delete = true;
var _edit = true;

// przypisanie odwolan do klass



function deleteAbbreviationShow()
{
    var deleteClass = $('.delete');
    var editClass = $('.edit');
    var linkClass = $('.link-abbreviation2');
    
    if (onoff && _delete && _edit)
    {
        deleteClass.css("display", "block");
        onoff = false;
        _delete = false;
        linkClass.addClass("link-abbreviation");
    }
    else if ((!onoff) && (!_delete))
    {
        deleteClass.css("display", "none");
        linkClass.removeClass("link-abbreviation");
        onoff = true;
        _delete = true;
    }
    else if ((!onoff) && (!_edit))
    {
        deleteClass.css("display", "block");
        editClass.css("display", "none");
        onoff = false;
        _edit = true;
        _delete = false;  
    }
}
    
function editAbbreviationShow()
{
    var deleteClass = $('.delete');
    var editClass = $('.edit');
    var linkClass = $('.link-abbreviation2');
    
    if (onoff && _delete && _edit)
    {
        editClass.css("display", "block");
        onoff = false;
        _edit = false;
        linkClass.addClass("link-abbreviation");
    }
    else if ((!onoff) && (!_edit))
    {
        editClass.css("display", "none");
        linkClass.removeClass("link-abbreviation");
        onoff = true;
        _edit = true;
    }
    else if ((!onoff) && (!_delete))
    {
        editClass.css("display", "block");
        deleteClass.css("display", "none");
        onoff = false;
        _delete = true;
        _edit = false;
    }
}

function changeColor(color)
    {
        var url = "url('image/"+color+".png')";
        var url1 = "url('image/"+color+".svg')";
        $('.abbreviation-add .abbreviation').css("background-image" , url );
        $('.abbreviation-edit .abbreviation').css("background-image" , url );
        $('.catalog-add .abbreviation').css("background-image" , url1 );
        $('.catalog-edit .abbreviation').css("background-image" , url1 );
    }
    
function checkUrl(text)
{
    var reg = /http/;
    var reg2 = /https/;
    
    if((reg.test(text)) || (reg2.test(text)))
        return text;
    else
        return "http://" + text;
}
    
