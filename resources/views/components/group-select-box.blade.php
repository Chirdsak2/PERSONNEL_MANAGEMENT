<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->

    <select class="form-select" id="group_id" name="group_id"  aria-label="Default select example" required @if (request()->routeIs('personnel.show')) disabled @endif>
        <option selected value="">เลือก</option>
        @foreach ($groups as $group)
            <option {{ $group->id == $groupId ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->group_name_th }}</option>
        @endforeach
    </select>
</div>
