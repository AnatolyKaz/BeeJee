 /////====================Вывод задач для редактирования
 $(document).ready(function editTaskList () {
    let editTaskList = document.getElementById('editBlockContainer');
    if (editTaskList) {
      $.ajax({
        url: 'ajax/editTaskList.php',
        type: 'POST',
        cache: false,
        data: {},
        dataType: 'html',
        success: function (data) {
          editTaskList.insertAdjacentHTML("afterbegin",`<div class="card mt-3" id="editTaskList">${data}</div>`);
        }
      });
    }
  });
  
////=================Авторизация
$('#authAdmin').click( function () {
    let login = $('#login').val();
    let password = $('#password').val();
  
    $.ajax({
      url: 'ajax/auth.php',
      type: 'POST',
      cache: false,
      data: {'login' : login , 'password' : password},
      dataType: 'html',
      success: function (data) {
        if (data == 'Готово'){
          $('#authAdmin').text(data);
        $('#errorBlock').hide();
        location="index.php";
        }
        else {
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      }
    });
  });
//=============обработка редактрирования
document.addEventListener("click",SaveEdit)

function SaveEdit (event) {
    let pushTarget = event.target 
    let saveEditButton = pushTarget.getAttribute('id')
    if (saveEditButton == 'saveEdit') {
        let taskId = pushTarget.getAttribute('task-id')
        let editText = pushTarget.previousElementSibling.value
        $.ajax({
            url: 'ajax/editTask.php',
            type: 'POST',
            cache: false,
            data: {'taskId' : taskId , 'editText' : editText },
            dataType: 'html',
            success: function () {
                pushTarget.style.backgroundColor = "green"
                setTimeout(function(){
                    document.location.reload(true);;
                    }, 2500);
            }
        });
    }
}
//================Выход===================
$('#exitAdmin').click( function () {
  $.ajax({
    url: 'ajax/exit.php',
    type: 'POST',
    cache: false,
    data: {},
    dataType: 'html',
    success: function (data) {
        document.location.reload(true);
      }
  });
});