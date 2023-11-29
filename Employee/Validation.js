

//--------------------------------Name Validation------------------------------------------------------ 

function validateName(elem)
{
var nameexp=/^([A-Za-z ]*)$/;
	if(elem.value.match(nameexp))
	{
		document.getElementById("name").innerHTML = "";
		return true;
	}
	else
	{
		
		document.getElementById("name").innerHTML = "<span  style='color: red;text: 12px;font-size: 14px;'>Alphabets Are Allowed</span>";
		elem.focus();
		return false;
	}  
}


//--------------------------------Date Of Birth Validation------------------------------------------------------ 

    var mydate = document.getElementById('txtdob');
    mydate.addEventListener('input', function() {
            var value = new Date(mydate.value),
                min = new Date(mydate.min),
                max = new Date(mydate.max);
	    if( !mydate.value.match(/\d{4}-\d{1,2}-\d{1,2}/))
       {
		document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select DOB</span>";
       }
	   else{

            if (value < min )
			 {
				document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Date</span>";
             }
			 else if(value > max)
			 {
				document.getElementById("mydateError").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Age Limit is 18</span>";
			 }
			 else
			  {
						document.getElementById("mydateError").innerHTML = "";

              }
	   }
    });
	
	
//--------------------------------Gender Validation------------------------------------------------------ 

function validateGender(elem)
{
    var gender=elem.value;
    if( gender=="Male" || gender=="Female"||gender=="Others")
       {
		document.getElementById("gendererr").innerHTML = "";
       }
	else
	{
		document.getElementById("gendererr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Choose Gender</span>";

	}
 }	
	
 
//--------------------------------District Validation------------------------------------------------------ 
function validateDistrict(elem)
{
    var district=elem.value;
    if( district=="")
       {
		document.getElementById("districterr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select District</span>";
       }
	else
		{
		document.getElementById("districterr").innerHTML = "";
       }
 }
 
 
//--------------------------------Place Validation------------------------------------------------------ 
	
  function validateCity(elem)
{
    var city=elem.value;
    if( city=="")
       {
		document.getElementById("cityerr").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Select City</span>";
       }
	 else
		{
		document.getElementById("cityerr").innerHTML = "";
       }
 }	

 
//--------------------------------Landmark Validation------------------------------------------------------ 

function validateLandmark(elem)
{
	var nameexp = /^[0-9a-zA-Z\s ]+$/;
   if(elem.value.match(nameexp))
       {
		document.getElementById("landmark").innerHTML = "";
		return true;
		   }
    else

		document.getElementById("landmark").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>special characters  Are not Allowed</span>";
		elem.focus();
		return false;
		}
		
//--------------------------------Housename Validation------------------------------------------------------ 

function validateHousename(elem)
{
	var nameexp = /^[0-9a-zA-Z\s ]+$/;
   if(elem.value.match(nameexp))
       {
		document.getElementById("housename").innerHTML = "";
		return true;
		   }
    else

		document.getElementById("housename").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>special characters  Are not Allowed</span>";
		elem.focus();
		return false;
}

//--------------------------------Pincode Validation------------------------------------------------------ 

function validatePincode(elem)
{
	var nameexp = /^[0-9 ]+$/;
	 if(elem.value.match(nameexp))
       {
		document.getElementById("pincode").innerHTML = "";
		 if(elem.value.length!=6)
		 {
					document.getElementById("pincode").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>6 Digits Needed</span>";
 
		 }
		   }
    else

		document.getElementById("pincode").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Only Digits Are Allowed</span>";
		elem.focus();
		return false;
}

//--------------------------------Email Validation------------------------------------------------------ 

function validateEmail(elem) 
{
   	var lastAtPos = elem.value.lastIndexOf('@');
  	var lastDotPos = elem.value.lastIndexOf('.');
    if(lastAtPos < lastDotPos && lastAtPos > 0 && (lastDotPos - lastAtPos) >1 && elem.value.indexOf('@@') == -1 && lastDotPos > 2 && (elem.value.length - lastDotPos) > 2 )
			{
				document.getElementById("email").innerHTML = "";
				return true;
			}
		else
				document.getElementById("email").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Invalid Email</span>";
				elem.focus();
				return false;

}

//--------------------------------Contact Validation------------------------------------------------------ 

function validateContact(elem)
{
	var nameexp = /^[0-9 ]+$/;
	 if(elem.value.match(nameexp))
       {
		document.getElementById("contact").innerHTML = "";
		if(elem.value.length!=10)
		{
					document.getElementById("contact").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>10 Digits Needed</span>";

		}
		   }
    else

		document.getElementById("contact").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Only Digits Are Allowed</span>";
		elem.focus();
		return false;
}


//--------------------------------Photo Validation------------------------------------------------------ 

function OnPhotoValidation() {

    var image = document.getElementById("photo");
	 var imagePath = image.value;
	var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
	if(imagePath=="")
	{
			document.getElementById("photocss").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Insert Photo</span>";
	}
	else{
    if (typeof (image.files) != "undefined") {
        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2); 
        if(size > 2) {
            alert('Please select image size less than 2 MB');
        }
		if (!allowedExtensions.exec(imagePath)) {
                alert('Invalid file type');
                image.value = '';
            }
		
    } else {
        alert("This browser does not support HTML5.");
    }
	}
}


//--------------------------------File Validation------------------------------------------------------ 

function fileValidation (){
        const fi = document.getElementById('proof');
		 var filePath = fi.value;
		 var allowedExtensions =/(\.doc|\.docx|\.odt|\.pdf|\.tex|\.txt|\.rtf|\.wps|\.wks|\.wpd)$/i;
        // Check if any file is selected.
		if(filePath=="")
		{
			document.getElementById("proofcss").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Insert Proof</span>";
		}
		else{
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >2048) {
                    alert(
                      "File too Big, please select a file less than 2mb");
                }
				 
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fi.value = '';
            }
            }
		  }
        }
    }
	
//--------------------------------Password Validation------------------------------------------------------ 

//password validation
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

//--------------------------------Show Password Eye Icon------------------------------------------------------ 

const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});


//--------------------------------Confirm Password Validation------------------------------------------------------ 

function validateConfirmPassword() 
{
	var cpassword=document.getElementById("cpassword").value;
	var password=document.getElementById("password").value;
	if(cpassword==password)
	{
		document.getElementById("scpassword").innerHTML = "";
		return true;
		}
    else
		document.getElementById("scpassword").innerHTML = "<span style='color: red;text: 12px;font-size: 14px;'>Password doesn't match</span>";
		elem.focus();
		return false;
}
