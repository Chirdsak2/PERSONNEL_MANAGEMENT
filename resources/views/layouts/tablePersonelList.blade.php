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

    .table {
        border: 1px;
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #212529;
        border-color: #32383e;
        text-align: center;
    }

    .table thead th:first-child {
        border-top-left-radius: 7px;
    }

    .table thead th:last-child {
        border-top-right-radius: 7px;
    }

    /* Pagination Style for Dark Theme */
    .pagination {
        /*  color: #fff;  Text color */
    }

    .page-link {
        /*  background-color: #343a40; Background color of the page link */
        /* border-color: #343a40;  Border color of the page link */
        color: #343a40;
    }

    .page-link:hover {
        background-color: #343a40;
        /* Background color of the page link on hover */
        border-color: #23272b;
        /* Border color of the page link on hover */
        color: #fff;
    }

    .page-item.active .page-link {
        background-color: #343a40;
        /* Background color of the active page link */
        border-color: #343a40;
        /* Border color of the active page link */
    }
</style>

<h2 class="mt-4 mb-2" align="center">รายการบุคลากร</h2> 

<div class="d-flex justify-content-end col-11 mb-1">
@php
    $groupId = session('group_id');
    $username = session('username');
@endphp
<a href="{{ route('personnel.create') }}" class="btn btn-info {{ $groupId != 1 ? 'disabled' : '' }}" ><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>

</div>

<div class="container form-personnel col-10 mb-5">
    <table class="table" border="1">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="10%">ลำดับ</th>
                <th scope="col" width="15%">รูปภาพบุคลากร</th>
                <th scope="col" width="30%">ชื่อ-สกุล</th>
                <th scope="col" width="30%">ตำแหน่ง</th>
                <th scope="col" width="15%">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $item)
                <tr>
                    <td align="center" scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td align="center"><img id="image-user" src="../uploads/{{ $item->user_picture }}" alt="">
                    </td>
                    <td>{{ $item->getPrefixName($item->prefix_id) }}{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td>{{ $item->getPositionName($item->position_id) }}</td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a class="btn btn-warning btn-sm {{ $groupId == 1 || $username == $item->username ? '' : 'disabled' }}" href="{{ route('personnel.edit', ['id' => $item->id]) }}" role="button" title=""><i class="fas fa-pencil"></i> แก้ไข</a>
                            <form action="{{ route('personnel.destroy', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm {{ $groupId == 1 && $item->id != 1 ? '' : 'disabled' }}" onclick="return confirm('คุณต้องการลบรายการนี้หรือไม่?')"><i class="fas fa-trash"></i> ลบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- แสดง pagination links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>



</div>
