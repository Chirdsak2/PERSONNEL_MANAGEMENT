<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->

    <select class="form-select" id="position_id" name="position_id"  aria-label="Default select example" required>
        <option selected value="">เลือก</option>
        @foreach ($positions as $position)
            <option {{ $position->id == $positionId ? 'selected' : '' }} value="{{ $position->id }}">{{ $position->position_full_name }}</option>
        @endforeach
    </select>
</div>
