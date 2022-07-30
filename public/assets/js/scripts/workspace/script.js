//Переключает отображение блоков
function showBlock(block) {
    if(block === 'tasks') {
        $("#button-show-branches").css('display', 'inline-block');
        $("#button-show-tasks").css('display', 'none');

        $("#block-tasks").css('display', 'block');
        $("#block-branches").css('display', 'none');
    } else if(block === 'branches') {
        $("#button-show-branches").css('display', 'none');
        $("#button-show-tasks").css('display', 'inline-block');

        $("#block-tasks").css('display', 'none');
        $("#block-branches").css('display', 'block');
    }
}

function startLoad(){
    $("#panel-load").css('display', 'block');
}

function endLoad(){
    $("#panel-load").css('display', 'none');
}