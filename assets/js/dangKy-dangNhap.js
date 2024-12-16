document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.getElementById("login-btn");
    const loginLink = document.getElementById("dangnhap-btn");
    const logoutBtn = document.querySelector('[href="#dangxuat"]');
    const userProfile = document.getElementById("user-profile");

    document.querySelector('[href="#sendemail"]').addEventListener('click', function(event) { 
        event.preventDefault(); 
        document.getElementById('rechange-passwword').style.display = 'none'; 
        document.getElementById('email-confirm').style.display = 'flex'; 
});
document.querySelector('[href="#sendemail-2"]').addEventListener('click', function(event) { 
    event.preventDefault(); 
    document.getElementById('email-confirm').style.display = 'none'; 
    document.getElementById('rewrite-pass').style.display = 'block'; 
});

    

    // Lưu URL hiện tại trước khi điều hướng
    if (window.location.href !== "trangChu.html") {
        localStorage.setItem("lastPage", window.location.href);
    }

    // Kiểm tra trạng thái đăng nhập
    if (localStorage.getItem("isLoggedIn") === "true") {
        loginLink.style.display = "none"; // Ẩn nút đăng nhập
        userProfile.style.display = "flex"; // Hiện profile
    } else {
        loginLink.style.display = "block"; // Hiện nút đăng nhập
        userProfile.style.display = "none"; // Ẩn profile
    }

    // Xử lý khi nhấn nút Đăng nhập
    loginBtn.addEventListener("click", (event) => {
        event.preventDefault(); // Ngăn hành động mặc định
        localStorage.setItem("isLoggedIn", "true");
        const lastPage = localStorage.getItem("lastPage") || "trangChu.html";
        window.location.href = lastPage;
    });

    // Xử lý khi nhấn nút Đăng xuất
    logoutBtn.addEventListener("click", (event) => {
        event.preventDefault(); // Ngăn hành động mặc định
        localStorage.setItem("isLoggedIn", "false");
        const lastPage = localStorage.getItem("lastPage") || "trangChu.html";
        window.location.href = lastPage;
    });


    // const loginBtn = document.querySelector('[href="#dangnhap"]')
    // const loginLink = document.getElementById("dangnhap-btn");
    // const userProfile = document.getElementById("user-profile");

    // // // Khi nhấn nút "Đăng nhập"
    // // loginBtn.addEventListener("click", (event) => {
    // //     event.preventDefault(); // Ngăn hành động mặc định của link
    // //     // Lưu trạng thái đăng nhập vào localStorage
    // //     localStorage.setItem("isLoggedIn", "true");
    // //     // Quay lại trang trước đó
    // //     history.back();
    // // });
    // loginBtn.addEventListener("click", (event) => {
    //     event.preventDefault(); // Ngăn hành động mặc định
    //     // Lưu trạng thái đăng nhập vào localStorage
    //     localStorage.setItem("isLoggedIn", "true");

    //     // Điều hướng về trang trước đó
    //     const lastPage = localStorage.getItem("lastPage") || "trangChu.html"; // Mặc định về trang chủ nếu không có URL trước đó
    //     window.location.href = lastPage;
    // });
    // // Kiểm tra trạng thái đăng nhập khi tải trang
    // if (localStorage.getItem("isLoggedIn") === "true") {
    //     loginLink.style.display = "none"; // Ẩn nút đăng nhập
    //     userProfile.style.display = "flex"; // Hiện ảnh profile
    // }

});