var survey_ddl = document.querySelector('#ddl-survey');
var question_ddl = document.querySelector('#ddl-question');
var answer_ddl = document.querySelector('#ddl-answer');
var result = document.querySelector('#result');
survey_ddl.addEventListener('change', () => {
    id = survey_ddl.value;
    AJAX(question_ddl, id, 'survey');
});
question_ddl.addEventListener('change', () => {
    id = question_ddl.value;
    AJAX(answer_ddl, id, 'question');
});
answer_ddl.addEventListener('change', () => {
    AJAX_Result(result, 'result', survey_ddl.value, question_ddl.value, answer_ddl.value);
});

function AJAX(render, id, key) {
    if (id != '') {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            render.innerHTML = xhr.responseText;
        };

        xhr.open('POST', 'fetch.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + encodeURIComponent(id) + '&key=' + encodeURIComponent(key));
    }
}
function AJAX_Result(render, key, id_survey, id_question, id_answer) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        render.innerHTML = xhr.responseText;
    };

    xhr.open('POST', 'fetch.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id_survey=' + encodeURIComponent(id_survey) +'&id_question=' + encodeURIComponent(id_question) + '&id_answer=' + encodeURIComponent(id_answer) +  '&key=' + encodeURIComponent(key));

}
