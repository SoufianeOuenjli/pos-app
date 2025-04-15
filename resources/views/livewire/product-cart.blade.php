<div class="product-list product-scroll mb-3" onmousedown="handleMouseDownProduct(event)"
    onmouseup="handleMouseUpProduct(event)" onmouseleave="handleMouseUpProduct(event)"
    onmousemove="handleMouseMoveProduct(event)">
    <!-- Your product table here -->
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Product</th>
                <th>QTY</th>
                <th>Price</th>
                <th>Total</th>
                <th>--</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $index => $item)
            {{-- @dd($item) --}}
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>
                    <button wire:click="decrementQty({{ $index }})">-</button>
                    {{ $item['qty'] }}
                    <button wire:click="incrementQty({{ $index }})">+</button>
                </td>
                <td>${{ number_format($item['price'], 2) }}</td>
                <td>${{ number_format($item['qty'] * $item['price'], 2) }}</td>
                <td><button wire:click="removeProduct({{ $index }})">x</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
