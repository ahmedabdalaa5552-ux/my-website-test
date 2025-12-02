// Handle Login
document.getElementById("loginForm")?.addEventListener("submit", function(e) {
    e.preventDefault();

    const username = document.getElementById("login-username").value.trim();
    const password = document.getElementById("login-password").value.trim();

    const savedUser = localStorage.getItem("username");
    const savedPass = localStorage.getItem("password");

    if (username === savedUser && password === savedPass) {
        alert("✔️ تم تسجيل الدخول بنجاح!");
        window.location.href = "home.html";
    } else {
        alert("❌ اسم المستخدم أو كلمة المرور غير صحيحة");
    }
});

// Handle Register
document.getElementById("registerForm")?.addEventListener("submit", function(e) {
    e.preventDefault();

    const username = document.getElementById("reg-username").value.trim();
    const email = document.getElementById("reg-email").value.trim();
    const password = document.getElementById("reg-password").value.trim();

    if (!username || !email || !password) {
        alert("❌ الرجاء ملء جميع الحقول");
        return;
    }

    localStorage.setItem("username", username);
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);

    alert("✔️ تم إنشاء الحساب بنجاح!");
    window.location.href = "index.html"; // العودة لصفحة تسجيل الدخول
});

// Logout function
function logout() {
    alert("تم تسجيل الخروج");
    window.location.href = "index.html";
}
