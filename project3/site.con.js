/*! DO NOT EDIT project3 2018-06-28 */
function Buttons(sel) {

    //console.log("Buttons constructor");

    var enigma = $(sel + " div");         // The enigma div
    var rows = enigma.find("button");    // All of the enigma buttons
    //console.log(rows.length);

    for(var r=0; r<rows.length; r++) {
        // Get a row
        var button = $(rows.get(r));
        var key = button.val();
        //console.log(key);
        this.installListener(r,button,key);
        //we are a button
    }
    var resetTag = enigma.parent().siblings(sel).children('p').children('input');
    //console.log(resetTag);
    this.resetListener(resetTag);

}
Buttons.prototype.installListener = function(row, button, letter) {
    var that = this;

    button.mousedown(function() {
        event.preventDefault();

        //console.log("Mouse down " + letter);
        button.parent().addClass('pressed');        //will show up red

        $.ajax({
            url:"post/enigma-js.php",
            data:{key:letter},
            method:"POST",
            success:function(data){
                var json = parse_json(data);
                //console.log('we successfully did it!');
                that.presentRotors(json.rotors);    //updated rotors
                that.lightOff();                    //turn off the previous coded letter light
                that.lightOn(json.lit);             //illuminate new light
            },
            error:function(xhr,status,error){
                //Error
            }
        });

    });

    button.mouseup(function() {
        event.preventDefault();
        button.parent().removeClass('pressed');     //turn off red
    });

    button.click(function() {
        event.preventDefault();
    });
}
Buttons.prototype.resetListener = function(button) {
    var that = this;

    button.click(function() {
        event.preventDefault();
        //console.log('We pushed reset!');

        $.ajax({
            url:"post/enigma-js.php",
            data:{reset:true},
            method:"POST",
            success:function(data){
                var json = parse_json(data);
                //console.log('we successfully reset!');
                that.presentRotors(json.rotors);    //updates rotors
                that.lightOff();                    //turns off the light that was on
            },
            error:function(xhr,status,error){
                //Error
            }
        });

    });
}

Buttons.prototype.presentRotors = function(rotors) {
    $("div .rotors").html(rotors);
}

Buttons.prototype.lightOn = function(light) {
    $("div .light-"+light).addClass('light-on');
}

Buttons.prototype.lightOff = function() {
    $("div .light-on").removeClass('light-on');
}


function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}