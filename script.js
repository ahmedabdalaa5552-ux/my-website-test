document.getElementById("registerForm")?.addEventListener("submit", async function(e) {
    e.preventDefault();

    const fullName = document.getElementById("fullname").value.trim();
    const nationalId = document.getElementById("nid").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const email = document.getElementById("email").value.trim();

    if (!fullName || !nationalId || !phone || !email) {
        alert("❌ الرجاء ملء جميع الحقول");
        return;
    }

    const data = {
        data: {
            fullname: fullName,
            national_id: nationalId,
            phone: phone,
            email: email
        }
    };

    try {
        const response = await fetch("https://sheetdb.io/api/v1/u0utqc3ngifxy", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            alert("✔️ تم التسجيل بنجاح!");
            document.getElementById("registerForm").reset();
        } else {
            alert("❌ حدث خطأ أثناء التسجيل");
        }
    } catch (error) {
        alert("❌ خطأ في الاتصال بالسيرفر");
    }
});
