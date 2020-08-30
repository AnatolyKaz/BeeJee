//==============Вывод текущих задач=============// 
$(document).ready(function taskList () {
  let taskList = document.getElementById('editBlockContainer');
  if (taskList) {
    $.ajax({
      url: 'ajax/Task.php',
      type: 'POST',
      cache: false,
      data: {},
      dataType: 'html',
      success: function (data) {
        taskList.insertAdjacentHTML("beforeend",`<div class="card mt-3" id="taskList">${data}</div>`);
      }
    });
  }
});

//==============Добавление задачи=============//
$('#insertTask').click( function () {
    let UserName = $('#UserName').val();
    let UserMail = $('#UserMail').val();
    let taskText = $('#taskText').val();
    
  
    $.ajax({
      url: 'ajax/InsertTask.php',
      type: 'POST',
      cache: false,
      data: {
        'UserName' : UserName,
        'UserMail' : UserMail,
        'taskText' : taskText,
        },
      dataType: 'html',
      success: function  (data) {
        console.log(data);
        if (data ==  1){
          $('#errorBlock').hide();
          $('#insertTask').text('Добавлено');
          setTimeout(function(){
            document.location.reload(true);;
            }, 2500);
          
        }
        else {
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      }
    });
  });
  


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

////============Манипуляции с заданиями
let container = document.querySelector('.container')
container.addEventListener('click',pushButton)

function pushButton (event) {
  let targetPush = event.target
  let targetId = targetPush.getAttribute('id')
  /////===============Delete Task===============
  if (targetId == 'deleteTask' ) {
    let taskId = targetPush.getAttribute('task-id')
    $.ajax({
      url: 'ajax/deleteTask.php',
      type: 'POST',
      cache: false,
      data: {'taskId' : taskId},
      dataType: 'html',
      success: function () {
        document.location.reload(true);
        }
    });
  }
  /////===============Edit Status===============
  if (targetId == 'newStatus' ) {
    let taskId = targetPush.getAttribute('task-id')
    $.ajax({
      url: 'ajax/newStatus.php',
      type: 'POST',
      cache: false,
      data: {'taskId' : taskId},
      dataType: 'html',
      success: function () {
        document.location.reload(true);
        }
    });
  }
}
