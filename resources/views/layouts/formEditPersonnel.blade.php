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
        border-radius: 7px;
        margin-bottom: 10px;
        /*
        margin-top: 10px;
        margin-bottom: 10px;
        */
    }

    #image-preview {
        max-width: 300px;
        max-height: 300px;
        border-radius: 7px;
        margin-bottom: 10px;
        /*
        margin-top: 10px;
        margin-bottom: 10px;
        */
    }

    .readonly-input {
        background-color: #f0f0f0;
        /* สีพื้นหลัง */
        cursor: not-allowed;
        /* เปลี่ยนรูปเมาส์เป็นไม่อนุญาตเมื่อถูกคลิก */
        /* opacity: 0.6;
        ทำให้ข้อความภายใน input เป็นสีอ่อนลง */
    }
</style>

<h2 class="mt-4 mb-2" align="center">แก้ไขข้อมูลบุคลากร</h2>

<div class="d-flex justify-content-end col-11 mb-1">
    <a href="{{ route('managePersonel') }}" class="btn btn-warning ">ย้อนกลับ</a>
</div>

<div class="container form-personnel col-10 mb-5">
    <form action="{{ url('updatePersonnel', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group col-3">
            <label for="user_picture">รูปภาพบุคลากร:</label>
            <div id="image-preview">
                <img id="image-preview" src="../uploads/{{ $user->user_picture }}" alt="">
            </div>
            <input type="file" class="form-control-file" id="user_picture" name="user_picture" accept="image/*"
                onchange="previewImage(event)">
        </div>

        @php
            //    dd($user)
        @endphp
        <div class="form-group col-3">
            <span style="color:red;">* </span><label for="prefix_id">คำนำหน้า:</label>
            <x-prefix-select-box :prefixId="$user->prefix_id" />

        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="firstname">ชื่อ:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}"
                required>
        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="lastname">นามสกุล:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}"
                required>
        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="telephone">เบอร์โทรศัพท์:</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="เบอร์โทรศัพท์มือถือ"
                value="{{ $user->telephone }}" onblur="validatePhoneNumber()" required>
        </div>
        <div class="form-group col-5">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="address">ที่อยู่:</label>
            {{-- <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required> --}}
            <textarea class="form-control" id="address" name="address">{{ $user->address }}</textarea>
        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="position_id">ตำแหน่ง:</label>
            <x-position-select-box :positionId="$user->position_id" />
        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="group_id">ประเภทบุคลากร:</label>
            <x-group-select-box :group_Id="$user->group_id" />
        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="username">Username:</label>
            <input type="text" class="form-control readonly-input" id="username" name="username" value="{{ $user->username }}"
                readonly>
        </div>
        <div class="form-group col-5">
            <span style="color:red;">* </span><label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}"
                required>
        </div>
        <div class="form-group mt-5" align="center">
            <a class="btn btn-warning btn-sm" href="{{ route('managePersonel') }}" role="button" title="">
                ย้อนกลับ</a>
            <button type="submit" class="btn btn-success btn-sm">บันทึกการเปลี่ยนแปลง</button>
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
</script>
