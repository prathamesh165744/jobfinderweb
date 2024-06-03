
function sendOTP() {
	const email = document.getElementById('email');
	const otpverify = document.getElementsByClassName('otpverify')[0];

	let otp_val = Math.floor(Math.random() * 10000);

	let emailbody = `<h2>Your OTP is </h2>${otp_val}`;
	Email.send({
		SecureToken: "f53ed713-9fe7-4620-97c1-aadc96018c38", // Replace with your actual SecureToken
		To: email.value,
		From: "mapariprathamesh50@gmail.com", // Replace with your email address
		Subject: "Email OTP using JavaScript",
		Body: emailbody,
	}).then(
		message => {
			if (message === "OK") {
				alert("OTP sent to your email " + email.value);

				otpverify.style.display = "block";
				const otp_inp = document.getElementById('otp_inp');
				const otp_btn = document.getElementById('otp-btn');

				otp_btn.addEventListener('click', () => {
					if (otp_inp.value == otp_val) {
						alert("Email address verified...");
					} else {
						alert("Invalid OTP");
					}
				});
			} else {
				console.error("Email sending failed:", message);
				alert("Email sending failed. Please try again later.");
			}
		}
	).catch(error => {
		console.error("Email sending error:", error);
		alert("Email sending failed. Please try again later.");
	});
}
