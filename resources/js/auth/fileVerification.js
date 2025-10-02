const uploadField = document.getElementById("logo");
const fileAlert = document.getElementById("logo_rules");
const fileAlertText = document.getElementById("logo_rules_p");

const MAX_FILE_SIZE = 2097152; // 1 MB in Bytes = 1048576;
const ALLOWED_TYPES = ["image/jpeg", "image/png", "image/svg+xml", "image/webp"];

uploadField.onchange = function() {
    
    if (!this.files.length) {
        return; 
    }
     const file = this.files[0];

    if(file.size > MAX_FILE_SIZE) {
       fileAlert.style.display = "block";
        fileAlertText.innerHTML = `File is to large, the maximum size is 2MB. Your file has ${(file.size / 1048576).toFixed(2)}MB.`;
        this.value = ""; 
    }
    else if (!ALLOWED_TYPES.includes(file.type)) {
        fileAlert.style.display = "block";
        fileAlertText.innerHTML = `The file type ${file.type} is not accepted, please try .png, .jpg, .svg or .webp.`;
        this.value = "";
    } 
    else
    {
        fileAlert.style.display = "none";
        fileAlertText.innerHTML = "";
    }
};
