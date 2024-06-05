@props(['selectedPositionId' => '']) 
{{-- ให้ selectedPositionId สามารถเป็นค่าว่างได้กรณีที่ไม่ได้ค้นหา --}}

<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->

<select class="form-select" id="position_id" name="position_id" aria-label="Default select example" @if (Route::currentRouteName() == 'addPersonnel') required @endif @if (request()->routeIs('personnel.show')) disabled @endif>
        <option selected value="">เลือก</option>
        @foreach ($positions as $position)
            <option {{ $position->id == $positionId || $position->id == $selectedPositionId ? 'selected' : '' }} value="{{ $position->id }}">{{ $position->position_full_name }}</option>

        @endforeach
    </select>
</div>

