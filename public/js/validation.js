function validateExpense() {
	var expenseForm=document.expense;

	var a=expenseForm.amount.value;
	if (isNaN(a)) {
		document.getElementById("expenseAmount").classList.add("d-block");
		return false;
	}

	return false;
}

function validateRegistration() {
	var regForm=document.registration;

	var firstName=regForm.fisrtName.value;
	var lastName=regForm.lastName.value;


	if (!/^[a-zA-Z]+$/.test(firstName)) {
		document.getElementById("fisrtNameFeedback").classList.add("d-block");
		return false;
	}else{
		document.getElementById("fisrtNameFeedback").classList.remove("d-block");

	}

	if (!/^[a-zA-Z]+$/.test(lastName)) {
		document.getElementById("lastNameFeedback").classList.add("d-block");
		return false;
	}else{
		document.getElementById("lastNameFeedback").classList.remove("d-block");

	}

	var passwordRegex = /^(?=.*[A-Z].*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,10}$/;

	var password=regForm.password.value;
	var confirmPassword=regForm.confirmPassword.value;
	alert(password+confirmPassword);

	if (password!=confirmPassword) {
		var text=document.getElementById("pwdFeedback");
		text.innerHTML="Password doesnt match";
		text.classList.add("d-block");
		return false;
	}

	if (!password.match(passwordRegex)) {
		var text=document.getElementById("pwdFeedback");
		text.innerHTML="Password must be 5-10 characters long and contain at least 2 uppercase letters, 1 number, and 1 special character (@, $, !, %, *, ?, &)."
		text.classList.add("d-block");
		return false;
	}	

	return true;
}