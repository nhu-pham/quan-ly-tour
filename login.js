document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    console.log('Email:', email);
    console.log('Password:', password);

    // Giả sử email và mật khẩu đúng
    if (email === 'admin@vietcharm.com' && password === 'admin123') {
        console.log('Login successful');
        document.getElementById('login-container').style.display = 'none';
        document.getElementById('admin-container').style.display = 'block';
    } else if (email === 'mienbac@vietcharm.com' && password === 'mienbac123') {
        console.log('Login successful - Miền Bắc');
        window.location.href = 'mienbac.html';
    } else if (email === 'mientrung@vietcharm.com' && password === 'mientrung123') {
        console.log('Login successful - Miền Trung');
        window.location.href = 'mientrung.html';
    } else if (email === 'miennam@vietcharm.com' && password === 'miennam123') {
        console.log('Login successful - Miền Nam');
        window.location.href = 'miennam.html';
    } else {
        console.log('Login failed');
        alert('Email hoặc mật khẩu không đúng');
    }
});