<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #ccc;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <h2 class="text-center">เข้าสู่ระบบ</h2>
        <form method="post">
            @csrf <!-- เพิ่ม CSRF token -->
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" class="form-control" id="username" placeholder="กรอกชื่อผู้ใช้">
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" class="form-control" id="password" placeholder="กรอกรหัสผ่าน">
            </div>
            {{-- <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button> --}}
            <a class="btn btn-primary btn-block" id="btn_login">เข้าสู่ระบบ</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $("#btn_login").click(function(e) {
                e.preventDefault(); // ป้องกันการโหลดหน้าใหม่

                let username = $("#username").val();
                let password = $("#password").val();

                if (password == "") {
                    Swal.fire({
                        title: "กรุณากรอกรหัสผ่าน!",
                        text: "",
                        icon: "warning",
                        confirmButtonColor: "#2A3E59",
                        confirmButtonText: "ตกลง",
                    });
                    $("#password").focus();
                    return;
                }

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('action') }}", // ใช้ route() function เพื่อกำหนด URL
                    data: {
                        "_token": "{{ csrf_token() }}", // เพิ่ม CSRF token
                        username: username,
                        password: password,
                    },

                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                title: response.message_text,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = response.detail;
                            });
                        } else {
                            Swal.fire({
                                title: response.message_text,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                            icon: 'error'
                        });
                    }

                });
            });
        });
    </script>
</body>

</html>
