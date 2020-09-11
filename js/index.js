"use strict"

(function taskListRender() {
  let taskList = document.getElementById('taskList');
  if (taskList) {
    $.ajax({
      url: 'ajax/Task.php',
      type: 'POST',
      cache: false,
      data: {},
      dataType: 'html',
      success: function (data) {
        taskList.insertAdjacentHTML("beforeend",`<div class="card mt-3" id="taskListCard">${data}</div>`);
      }
    });
  }
})();


document.addEventListener('click',pushButton)

let sortStatus

function pushButton (event) {

  let targetPush = event.target
  let targetId = targetPush.getAttribute('id')

  if (targetId == 'newStatus') {
    editStatus();
  }
  if (targetId == 'exitAdmin') {
    exitAdmin();
  }
  if (targetId == 'insertTask') {
    newTask();
  }
  if (
  targetId == 'sortNameButton' || 
  targetId == 'sortEmailButton' || 
  targetId == 'sortStatusButton'
  ) {
    sortStatus = targetId
    sortTask();
  }
  
 
}

function newTask() {

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
        if (data ==  1){
          $('#errorBlock').hide();
          $('#insertTask').text('Добавлено');
          setTimeout(function(){
            document.location.reload(true);
            }, 2500);
          
        }
        else {
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      }
    });
}

function sortTask() {

  $.ajax({
    url: 'ajax/Task.php',
    type: 'POST',
    cache: false,
    data: {'sortStatus' : sortStatus},
    dataType: 'html',
    success: function (data) {
      $('#taskList').empty();
      taskList.insertAdjacentHTML("beforeend",`<div class="card mt-3" id="taskListCard">${data}</div>`);
    }
  });
}

function editStatus() {

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

function deleteTask() {

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
};

function exitAdmin() {

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
}