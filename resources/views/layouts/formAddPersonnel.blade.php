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
</style>
<div class="container mt-4 col-8 ">
    <h2 class="mb-3" align="center">ลงทะเบียนข้อมูลบุคลากร</h2>
    <form class="mb-5" action="{{ url('storePersonnel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-personnel">
            <div class="form-group col-3">
                <label for="user_picture">รูปภาพผู้ใช้:</label>
                <div id="image-preview"></div>
                <input type="file" class="form-control-file" id="user_picture" name="user_picture" accept="image/*"
                    onchange="previewImage(event)">
            </div>


            <div class="form-group col-3">
                <label for="prefix_id">คำนำหน้า:</label>
                <x-prefix-select-box />
            </div>
            <div class="form-group col-5">
                <label for="firstname">ชื่อ:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="" required>
            </div>
            <div class="form-group col-5">
                <label for="lastname">นามสกุล:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="" required>
            </div>
            <div class="form-group col-5">
                <label for="telephone">เบอร์โทรศัพท์:</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="เบอร์โทรศัพท์มือถือ" onblur="validatePhoneNumber()" required>
            </div>
            <div class="form-group col-5">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="" required>
            </div>
            <div class="form-group">
                <label for="address">ที่อยู่:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="form-group col-5">
                <label for="position_id">ตำแหน่ง:</label>
                <x-position-select-box />
            </div>
            <div class="form-group col-5">
                <label for="group_id">ประเภทบุคลากร:</label>
                <x-group-select-box />
            </div>
            <div class="form-group col-5">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="" required>
            </div>
            <div class="form-group col-5">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="" required>
            </div>
            <div class="form-group mt-5" align="center">
                <a class="btn btn-warning btn-sm" href="{{ route('managePersonel') }}" role="button" title=""> ย้อนกลับ</a>
                <button type="submit" class="btn btn-success btn-sm">ลงทะเบียน</button>
            </div>
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
