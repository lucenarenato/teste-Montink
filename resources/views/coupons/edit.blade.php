<input type="text" name="code" value="{{ old('code', $coupon->code) }}" class="form-control" required>

<input type="number" step="0.01" name="discount" value="{{ old('discount', $coupon->discount) }}" class="form-control" required>

<input type="number" step="0.01" name="min_subtotal" value="{{ old('min_subtotal', $coupon->min_subtotal) }}" class="form-control" required>

<input type="date" name="valid_until" value="{{ old('valid_until', $coupon->valid_until->format('Y-m-d')) }}" class="form-control" required>
