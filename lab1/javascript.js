function getParametres(x,y,r) {
    $.ajax({
        type: "POST",
        url: "script.php",
        data: {paramx:x, paramy:y, paramr:r}
    }).done(function(result){
            $('#answer').html(result)
            });
}

function checkParameterValue(){
    $('#validation_x').html('');
    $('#validation_y').html('');
    $('#validation_r').html('');
    
    X = ['-3', '-2', '-1', '0', '1', '2', '3', '4', '5'];
    
    var x = $('input[name=paramx]:checked').val();
    var y = $('#paramy').val();
    var r = $('#paramr').val();
    var answer = true;
    
    if (!X.includes(x)) {
        $('#validation_x').html('Wrong value X');
        answer = false;
    }
    if (!(-3 <= y && y <= 3) || y == ""){
        $('#validation_y').html('Y must be from -3 to 3');
        answer = false;
    }
    if (!(1 <= r && r <= 4)){
        $('#validation_r').html('R must be from 1 to 4');
        answer = false;
    }
    
    if (answer){
        getParametres(x, y, r);
    } 
}