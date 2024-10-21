function onPopupMember(username){
    event.preventDefault();
    $.post("post/popup_member.php", {
        action : "SHOW_MEMBER_POPUP",
        username : username
    }, function (result) {
        try{
            $("#xl_modal .modal_data").html("");
            $("#xl_modal .modal_data").html(result);
        }catch (e) {
            console.log(e)
        }
    }).done(function (item) {
        $("#xl_modal .modal-title").html("<i class='far fa-id-card'></i> รายละเอียดสมาชิก");
        // $("#xl_modal").modal('show');
        var myModal = new bootstrap.Modal(document.getElementById('xl_modal'), {
            // backdrop: "static"
        });
        myModal.show();
    });
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function removeCommas(x){
    return x.replace(/,/g, '');
}

// ใส่ได้เฉพาะอักษัร
function validateText(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[A-za-zก-๙]/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}


function inputAZ(evt){
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[A-z0-9@-\s\.\_]/;
  if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

function inputEN(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[A-z0-9]/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function inputTH(evt){
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[ก-๙]/;
  if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

function inputTxt(evt){
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[A-zก-๙0-9@-\s\.\(\)\[\]{}#\_]/;
  if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

function inputLink(evt){
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[A-z0-9@-\s\.:/]/;
  if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

function inputNum(evt){
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]/;
  if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
  }
}


function inputIP(evt){
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9.|]/;
  if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
  }
}


function inputFloat(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9.]/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function inputFloatComma(evt) {
    var theEvent = evt || window.event;
    var input = evt.target; // อ้างอิงถึง input ที่เรียกใช้ฟังก์ชันนี้

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }

    // ตรวจสอบว่าตัวอักษรเป็นตัวเลข จุดทศนิยม หรือจุลภาค
    var regex = /[0-9.,]/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    } else {
        // อนุญาตให้คีย์ทำงานและปรับการแสดงผลใน input field
        setTimeout(function() {
            var value = input.value.replace(/,/g, ''); // ลบจุลภาคทั้งหมดก่อน
            var parts = value.split('.'); // แยกส่วนที่เป็นทศนิยม
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ","); // เพิ่มจุลภาคทุกๆ 3 ตัวเลขในส่วนที่ไม่ใช่ทศนิยม
            input.value = parts.join('.'); // รวมค่าที่แปลงแล้วกลับเข้าไปใน input field
        }, 0);
    }
}

function txtUpper(evt) {
    var theEvent = evt || window.event;
    var txt = theEvent.target.value.toLocaleUpperCase();
    // document.getElementById(theEvent.target.id).value = txt;
    theEvent.target.value = txt;
}

function txtLower(evt) {
    var theEvent = evt || window.event;
    var txt = theEvent.target.value.toLowerCase();
    // document.getElementById(theEvent.target.id).value = txt;
    theEvent.target.value = txt;
}

function onChangeAgent(obj){
  event.preventDefault();
  var val = $(obj).val();
  Swal.fire({
    title: 'แจ้งเตือนการเปลี่ยน Agent',
    html: `ต้องการการเปลี่ยนเป็ย Agent : `+val+` ใช่ หรือ ไม่ ?`,
    icon: "danger",
    showCancelButton: true,
    confirmButtonText: 'ตกลง',
    cancelButtonText: `ยกเลิก`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.post("change_theme.php",{
        action : "CHANGE_AGENT",
        Agent : val
      },function(resultHtml){
        $("#rsStatus").html(resultHtml);
      })
    }
  })

}
