// fetch data
async function FetchDataJson(url,formData){
    const res = await fetch(
        url,
        {
            method: 'POST',
            body: formData,
        },
    );
    return res.json();
}

function InputPasswordType(elem){
    console.log(elem.id);
    let InputPass = document.getElementById(elem.id)
    let IdInput = InputPass.dataset.id
    console.log(IdInput)
    let InputPassword = document.getElementById(IdInput)

    if (InputPassword.type === "password") {
        InputPassword.type = "text";
    } else {
        InputPassword.type = "password";
    }
}

function AlertAutoCloseTimer(title,file='',timer='1500',text='กำลังเข้าดำเนินการ ...'){
    Swal.fire(
        {
            // position: "bottom-end",
            title: title,
            text: text,
            timer: timer,
            icon: 'success',
            showConfirmButton: false,
        }
    ).then((result) => {
        if(file){
            window.location.replace(file);
        }
        // window.location.assign("main.php");
    })
}

function showMiniAlert(title){
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: title
    });
}

function AlertError(title="เกิดข้อผิดพลาด"){
    /*Swal.fire(
        {
            title: title,
            // text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
            icon: "error",
            confirmButtonClass: 'btn btn-primary w-xs mt-2',
            buttonsStyling: false,
            confirmButtonText: "ตกลง",
            showCloseButton: true,
            allowOutsideClick: false,
        }
    )*/
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "error",
        title: title
    });
}

async function onProfileAccount(){
    $.post("post/profile_search.php",{
        action:"InfoUsername"
    },function(result){
        $("#modal-title").html('ข้อมูลโปรไฟล์');
        $("#modal-content").html(result);
    }).done(function(result){
        $("#myModal").modal('show');
    })
}

async function onChangePassAccount(){
    $.post("post/profile_search.php",{
        action:"ChangePassAccount"
    },function(result){
        $("#modal-title").html('ข้อมูลโปรไฟล์');
        $("#modal-content").html(result);
    }).done(function(result){
        $("#myModal").modal('show');
        $("#password-contain").css('display','block');
        const myInput = document.getElementById("NewPassword");
        myInput.onkeyup = function () {
            chekcpassword(myInput,"SubmitChangeAccount")
        };
    })
    /*const myModal = new bootstrap.Modal(document.getElementById('myModal'))
    myModal.show()

    const dataForm = new FormData();
    // dataForm.append('id', id);
    dataForm.append('action', 'ChangePassAccount');
    const res = FetchDataJson('post/set_acc_search.php',dataForm);
    // console.log(res)
    const resData = await res;
    console.log(resData)
    document.getElementById('modal-title').innerText = 'เปลี่ยนรหัสผ่าน'
    document.getElementById('modal-content').innerHTML = resData.html
    //
    document.getElementById("password-contain").style.display = "block";
    const myInput = document.getElementById("NewPassword");
    //
    //
    myInput.onkeyup = function () {
        chekcpassword(myInput,"SubmitChangeAccount")
    };*/
}

function onChangePasswordAccount(){
    const forms = document.getElementsByClassName('needs-validation');
    if (forms)
        var validation = Array.prototype.filter.call(forms, function (FormResetPassAccount) {
            FormResetPassAccount.onsubmit = async function(event) {
                event.preventDefault();
                event.stopPropagation();
                // document.getElementById("SubmitChangeAccount").disabled = true;
                if (FormResetPassAccount.checkValidity() === true) {
                    const form = document.getElementById('FormChangePassAccount');
                    const data = new FormData(form);
                    data.append('action', 'ChangePasswordAccount');
                    // console.log(data)
                    try {
                        const res = FetchDataJson('post/profile_search.php',data);
                        const resData = await res;
                        // console.log(resData)
                        if(resData.result){
                            AlertAutoCloseTimer(resData.remark);
                            // await SearchUser();
                            HideModal();
                            document.getElementById("SubmitChangeAccount").disabled = false;
                        }else{
                            AlertError(resData.remark);
                        }
                    } catch (err) {
                        console.log(err.message);
                    }
                }else{
                    FormResetPassAccount.classList.add('was-validated');
                }
            }
        });
}

function onMatchPass(elem){
    let PasswordNew = document.getElementById(elem.id)
    let PassC = PasswordNew.dataset.pass
    let ConfirmPasswordNew = document.getElementById(PassC)

    // const PasswordNew = document.getElementById(pass);
    // const ConfirmPasswordNew = document.getElementById(confirm_pass);
    if (PasswordNew.value !== ConfirmPasswordNew.value) {
        ConfirmPasswordNew.setCustomValidity("Passwords Don't Match");
    } else {
        ConfirmPasswordNew.setCustomValidity("");
    }
}

function chekcpassword(myInput,idSubmit=''){
    var letter = document.getElementById("pass-lower");
    var capital = document.getElementById("pass-upper");
    var number = document.getElementById("pass-number");
    var length = document.getElementById("pass-length");
    var special = document.getElementById("pass-special");

    let countCheck = 0;

    var specialCaseLetters = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    if (myInput.value.match(specialCaseLetters)) {
        special.classList.remove("invalid");
        special.classList.add("valid");
        countCheck++
    } else {
        special.classList.remove("valid");
        special.classList.add("invalid");
    }

    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
        countCheck++
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
        countCheck++
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
        countCheck++
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
        countCheck++
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }

    if(countCheck === 0){
        document.getElementById(idSubmit).disabled = false;
    }else if(countCheck === 5){
        document.getElementById(idSubmit).disabled = false;
    }else{
        document.getElementById(idSubmit).disabled = true;
    }

}

function enterAsTab(obj){
    $("#"+obj).on('keydown', 'input, select, textarea', function(e) {
        var self = $(this)
            , form = self.parents('form:eq(0)')
            , focusable
            , next
            , prev
        ;

        if (e.shiftKey) {
            if (e.keyCode == 13) {
                focusable =   form.find('input,a,select,button,textarea').filter(':visible');
                prev = focusable.eq(focusable.index(this)-1);

                if (prev.length) {
                    prev.focus();
                } else {
                    form.submit();
                }
                return false;
            }
        } else if (e.keyCode == 13) {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }

    });
}

async function CountdownTimer(id,sec,fn=undefined){
    var count_down = sec;
    return x = await setInterval(function() {
        let seconds = count_down;
        if(id!=""){
            document.getElementById(id).innerHTML = seconds;
        }
        count_down -= 1

        if (seconds <= 0) {
            // clearInterval(x);
            count_down = sec
            // document.getElementById(id).innerHTML = sec;
            // console.log(fn)
            if(fn !== undefined){
                fn();
            }

        }
    }, 1000);
}

// LogOut system control
function onLogOut(){
    Swal.fire({
        title: "แจ้งเตือน",
        text: "ต้องการออกจากระบบ ใช่หรือไม่ ?",
        icon: "warning",
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-danger w-xs me-2 mt-2",
            cancelButton: "btn btn-secondary w-xs mt-2"
        },
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
        buttonsStyling: false,
        showCloseButton: true
    }).then(async function (result) {
        if (result.value) {
            try {
                const formData = new FormData();
                formData.append('action', 'LogOut');
                const res = FetchDataJson('post/index_search.php',formData);
                const resData = await res;
                if(resData.Result){
                    AlertAutoCloseTimer('Log Out!','index.php');
                }else{
                    alert('Error Log Out!')
                }
            } catch (err) {
                console.log(err.message);
            }
        }
    });
}