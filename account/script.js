var step1;
var step2;
var step3;
var nextButton = document.querySelector(".nextButton");
var verifyButton = document.querySelector(".verifyButton");
var inputs = document.querySelectorAll(".otp-input");
let otp = "";

window.addEventListener("load",()=>{
    step1 = document.querySelector(".step-1"),
    step2 = document.querySelector(".step-2"),
    step3 = document.querySelector(".step-3");
    inputs = document.querySelectorAll(".otp-input input");
    verifyButton = document.querySelector(".verifyButton");
    verifyButton.classList.add("disableButton");
    const loading_icon = document.getElementById("loading_icon");
    const right_arr = document.getElementById("right_arr");
    inputs.forEach((input)=>{
        input.addEventListener("keyup",function(e){
            const id = new Number(e.target.id);
            if(e.key === "Backspace" && id != 1){
                document.getElementById(id-1).focus();
                document.getElementById(id-1).select();
            }
            else{
                const pt = /[0-9]/;
                if(pt.test(e.key)){
                    e.target.value = e.target.value.substr(0,1);
                    if(id != 4){
                        document.getElementById(id+1).focus();
                        document.getElementById(id+1).select();
                    }
                }
                else e.target.value = "";
            }

            if(inputs[0].value != "" && inputs[1].value != "" && inputs[2].value != "" && inputs[3].value != "")
                verifyButton.classList.remove("disableButton");
            else verifyButton.classList.add("disableButton");

        });
    });

    emailjs.init("e_xyGeOoeq2RZbOIA");
    const ServiceID = "service_qm14ndg";
    const TemplateID = "template_ihchkmc";
    nextButton = document.querySelector(".nextButton");
    nextButton.classList.add("disableButton");
    nextButton.addEventListener("click",()=>{
        otp = Math.floor(1000 + Math.random() * 9000);
        const emailAddress = document.getElementById("emailAddress").value;
        const templateParameter = {OTP: otp,userEmail:emailAddress};
        document.getElementById("userEmailAddress-1").innerHTML = emailAddress;
        document.getElementById("userEmailAddress-2").innerHTML = emailAddress;
        nextButton.innerHTML = "<span class='material-symbols-outlined' id = 'loading_icon'>progress_activity</span>";
        right_arr.style.display = "none";
        emailjs.send(ServiceID,TemplateID,templateParameter).then((res)=>{
            console.log(res);
            step1.style.display = "none";
            step2.style.display = "block";
        },(err)=>{
            console.log(err);
        });
    });
    step2.style.display = "none";
    step3.style.display = "none";
});

function validateEmail(email){
    let re = /\S+@\S+\.\S+/;
    if(re.test(email))
        nextButton.classList.remove("disableButton");
    else    nextButton.classList.add("disableButton");
}

function verifyOTP(){
    let userOTP = "";
    inputs.forEach((input)=>{
        userOTP += input.value;
    })
    if(userOTP.localeCompare(otp) === 0){
        step2.style.display = "none";
        step3.style.display = "block";
    }
    else alert("Invalid OTP");

}