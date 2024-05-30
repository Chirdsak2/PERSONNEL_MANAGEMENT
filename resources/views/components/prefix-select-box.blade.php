<select class="form-select" id="prefix_id" name="prefix_id" aria-label="Default select example" required>
    <option selected value="">เลือก</option>
    @foreach ($prefixs as $prefix)
        <option {{ $prefix->id == $prefixId ? 'selected' : '' }} value="{{ $prefix->id }}">
            {{ $prefix->prefix_name_th }}</option>
    @endforeach
</select>
