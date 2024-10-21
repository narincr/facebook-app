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

function AlertError(title="เกิดข้อผิดพลาด"){
    Swal.fire(
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
    )
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