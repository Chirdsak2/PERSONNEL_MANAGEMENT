<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .form-personnel {
        /*
    max-width: 400px;
    margin-top: 100px;
    */
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px #ccc;
    }

    #preview-image {
        max-width: 300px;
        max-height: 300px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .position-relative {
        position: relative;
    }

    .usernameFeedback {
        display: none;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: red;
        /* font-size: 1.5rem;
        Ensure the icon is visible */
    }
</style>

<h2 class="mt-4 mb-2" align="center">ลงทะเบียนข้อมูลบุคลากร</h2>

<div class="d-flex justify-content-end col-11 mb-1">
    <a href="{{ route('managePersonel') }}" class="btn btn-warning ">ย้อนกลับ</a>
</div>

<div class="container form-personnel col-10 mb-5">
    <form id="userForm" action="{{ url('storePersonnel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-3 mb-3">
            <label for="user_picture">รูปภาพบุคลากร:</label>
            <div id="image-preview"></div>
            <input type="file" class="form-control-file" id="user_picture" name="user_picture" accept="image/*"
                onchange="previewImage(event)">
        </div>
        <div class="form-group col-3 mb-3">
            <span style="color:red;">* </span><label for="prefix_id">คำนำหน้า:</label>
            <x-prefix-select-box />
        </div>
        <div class="form-group col-5 mb-3">
            <span style="color:red;">* </span><label for="firstname">ชื่อ:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="" required>
        </div>
        <div class="form-group col-5 mb-3">
            <span style="color:red;">* </span><label for="lastname">นามสกุล:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="" required>
        </div>
        <div class="form-group col-5 mb-3">
            <span style="color:red;">* </span><label for="telephone">เบอร์โทรศัพท์:</label>
            <input type="text" class="form-control" id="telephone" name="telephone"
                placeholder="เบอร์โทรศัพท์มือถือ" onblur="validatePhoneNumber()" required>
        </div>
        <div class="form-group col-5 mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="">
        </div>
        <div class="form-group mb-3">
            <label for="address">ที่อยู่:</label>
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
        <div class="form-group col-5 mb-3">
            <span style="color:red;">* </span><label for="position_id">ตำแหน่ง:</label>
            <x-position-select-box />
        </div>
        <div class="form-group col-5 mb-3">
            <span style="color:red;">* </span><label for="group_id">ประเภทบุคลากร:</label>
            <x-group-select-box />
        </div>
        <div class="form-group col-5 mb-3 position-relative">
            <span style="color:red;">* </span><label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value=""
                oninput="validateInputTH(this)" required>
            <small id="usernameFeedbackFalse" class="form-text text-danger" style="display:none;">Username
                ถูกใช้งานแล้ว</small>
            <small id="usernameFeedbackTrue" class="form-text text-success" style="display:none;">สามารถใช้ Username
                นี้ได้</small>
            <span id="usernameFeedback3" class="position-absolute usernameFeedback"><i
                    class="fas fa-warning "></i></span>
            <span id="usernameFeedback4" class="position-absolute usernameFeedback" style="color:green;"><i
                    class="fas fa-check-circle"></i></span>
        </div>
        <div class="form-group col-5 mb-3">
            <span style="color:red;">* </span><label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="" oninput="validateInputTH(this)" required>
        </div>
        <div class="form-group mt-5" align="center">
            <a class="btn btn-warning btn-sm" href="{{ route('managePersonel') }}" role="button" title="">
                ย้อนกลับ</a>
            <button type="submit" class="btn btn-success btn-sm">ลงทะเบียน</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/jquery.inputmask.js"></script>
<!-- Input Mask js -->
<script src="../assets/plugins/form-mask/js/inputmask.js"></script>
<script src="../assets/plugins/form-mask/js/jquery.inputmask.js"></script>
<script src="../assets/plugins/form-mask/js/autoNumeric.js"></script>

<script>
    $(document).ready(function() {
        $('#username').on('blur', function() {
            var username = $(this).val();
            if (username) {
                $.ajax({
                    url: '{{ route('validate.username') }}',
                    type: 'GET',
                    data: {
                        username: username
                    },
                    success: function(response) {
                        console.log(response.exists);
                        if (response.exists) {
                            $('#usernameFeedbackFalse').show();
                            $('#usernameFeedbackTrue').hide();
                            $('#usernameFeedback3').show();
                            $('#usernameFeedback4').hide();
                            $('#username').css('border-color', 'red');
                            $('#username').css('filter',
                                'drop-shadow(0px 0px 3px red)'
                                ); /* เพิ่มเอฟเฟ็กต์แสงสีแดง */
                        } else {
                            $('#usernameFeedbackFalse').hide();
                            $('#usernameFeedbackTrue').show();
                            $('#usernameFeedback3').hide();
                            $('#usernameFeedback4').show();
                            $('#username').css('border-color', 'green');
                            $('#username').css('filter',
                                'drop-shadow(0px 0px 3px #33FF33)'
                                ); /* เพิ่มเอฟเฟ็กต์แสงสีเขียว */
                        }
                    },
                    error: function(xhr) {
                        console.error('An error occurred while checking the username.');
                    }
                });
            }
        });

        $('#userForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var username = $('#username').val();
            var form = $(this); // เก็บฟอร์มไว้ในตัวแปร

            $.ajax({
                url: '{{ route('validate.username') }}',
                type: 'GET',
                data: {
                    username: username
                },
                success: function(response) {
                    // Handle success - for example, show a success message or redirect
                    // console.log(response);
                    if (response.exists == true) {
                        $('#username').val('');
                        $('#username').focus();
                    } else {
                        form.unbind('submit').submit();
                        return;
                    }

                },
                error: function(xhr) {
                    console.error('An error occurred while submitting the form.');
                    // Handle error - for example, show an error message
                }
            });
        });
    });

    $("#telephone").inputmask({
        mask: "999-999-9999"
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.innerHTML = '<img id="preview-image" src="' + reader.result + '" alt="Preview Image">';
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function validatePhoneNumber() {
        let phoneNumber = document.getElementById('telephone').value.replace(/[-_]/g, '');
        console.log(phoneNumber);
        if (phoneNumber.length === 10) {

        } else if (phoneNumber != '') {
            Swal.fire({
                title: "โปรดกรอกเบอร์โทรศัพท์ที่มี 10 หลัก",
                icon: "warning",
                confirmButtonText: "ยืนยัน",
            })
            $("#telephone").val('');
        }
    }

    function validateInputTH(input) {
        // // ใช้ regular expression เพื่อตรวจสอบว่ามีตัวอักษรที่ไม่ใช่ภาษาไทยหรือไม่ และไม่มีช่องว่าง
        var regex = /^[^\u0E00-\u0E7F\s]+$/;
        if (!regex.test(input.value)) {
            // ถ้ามีตัวอักษรภาษาไทยหรือช่องว่างในข้อมูลที่กรอกเข้ามา ลบทั้งตัวอักษรภาษาไทยและช่องว่างออกจากข้อมูลที่กรอกในช่อง input
            input.value = input.value.replace(/[\u0E00-\u0E7F\s]/g, '');
        }
    }
</script>
