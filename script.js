const API = "https://sheetdb.io/api/v1/ecxq5ppvzjdx7";

document.getElementById("loginForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    let email = document.getElementById("email").value;
    let pass = document.getElementById("password").value;

    let response = await fetch(`${API}/search?email=${email}`);
    let data = await response.json();

    if (data.length === 0) {
        alert("البريد غير موجود");
        return;
    }

    if (data[0].password === pass) {
        alert("تم تسجيل الدخول بنجاح");
        localStorage.setItem("user", JSON.stringify(data[0]));
        window.location.href = "home.html";
    } else {
        alert("كلمة المرور غير صحيحة");
    }
});