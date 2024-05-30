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
    }
</style>
<div class="container mt-4 col-8">
    <h2 class="mb-1" align="center">ลงทะเบียนข้อมูลบุคลากร</h2>
    <form action="{{ url('storePersonnel') }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" class="form-control" id="telephone" name="telephone" value="" required>
            </div>
            <div class="form-group col-5">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="" required>
            </div>
            <div class="form-group">
                <label for="address">ที่อยู่:</label>
                <input type="text" class="form-control" id="address" name="address" value="" required>
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
            <div class="form-group mt-3 mb-5" align="center">
                <button type="submit" class="btn btn-success">ลงทะเบียน</button>
            </div>
        </div>
    </form>
</div>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.innerHTML = '<img id="preview-image" src="' + reader.result + '" alt="Preview Image">';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
