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
        /*
        margin-top: 10px;
        margin-bottom: 10px;
        */
    }

    #image-preview {
        max-width: 300px;
        max-height: 300px;
        border-radius: 7px; 
        /*
        margin-top: 10px;
        margin-bottom: 10px;
        */
    }
</style>
<div class="container  mt-5 col-8 mb-5">
    <h2 class="mb-4" align="center">แก้ไขข้อมูลบุคลากร</h2>
    <form action="{{ url('updatePersonnel', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-personnel">
            <div class="form-group col-3">
                <label for="user_picture">รูปภาพผู้ใช้:</label>
                <div id="image-preview"><img id="image-preview" src="../uploads/{{ $user->user_picture }}"
                        alt="">
                </div>
                <input type="file" class="form-control-file" id="user_picture" name="user_picture" accept="image/*"
                    onchange="previewImage(event)">
            </div>

            @php
                //    dd($user)
            @endphp
            <div class="form-group col-3">
                <label for="prefix_id">คำนำหน้า:</label>
                <x-prefix-select-box :prefixId="$user->prefix_id" />

            </div>
            <div class="form-group col-5">
                <label for="firstname">ชื่อ:</label>
                <input type="text" class="form-control" id="firstname" name="firstname"
                    value="{{ $user->firstname }}" required>
            </div>
            <div class="form-group col-5">
                <label for="lastname">นามสกุล:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}"
                    required>
            </div>
            <div class="form-group col-5">
                <label for="telephone">เบอร์โทรศัพท์:</label>
                <input type="text" class="form-control" id="telephone" name="telephone"
                    value="{{ $user->telephone }}" required>
            </div>
            <div class="form-group col-5">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
            </div>
            <div class="form-group">
                <label for="address">ที่อยู่:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}"
                    required>
            </div>
            <div class="form-group col-5">
                <label for="position_id">ตำแหน่ง:</label>
                <x-position-select-box :positionId="$user->position_id" />
            </div>
            <div class="form-group col-5">
                <label for="group_id">ประเภทบุคลากร:</label>
                <x-group-select-box :group_Id="$user->group_id" />
            </div>
            <div class="form-group col-5">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"
                    required>
            </div>
            <div class="form-group col-5">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}"
                    required>
            </div>
            <div class="form-group  mt-5" align="center">
                <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
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
