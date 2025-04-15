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
                <tr class="align-middle">
                    <td class="fw-medium">{{ $item['name'] }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-primary rounded-circle p-1"
                                wire:click="decrementQty({{ $index }})" style="width:28px; height:28px">
                                <i class="bi bi-dash-lg"></i>
                            </button>
                            <span class="mx-2">{{ $item['qty'] }}</span>
                            <button class="btn btn-sm btn-outline-primary rounded-circle p-1"
                                wire:click="incrementQty({{ $index }})" style="width:28px; height:28px">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td class="fw-semibold">${{ number_format($item['qty'] * $item['price'], 2) }}</td>
                    <td>
                        <button class="btn btn-link text-danger p-0 btn-remove-product" wire:click="removeProduct({{ $index }})"
                            title="Remove item">
                            <i class="bi bi-trash fs-5"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
