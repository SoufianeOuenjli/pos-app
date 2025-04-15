<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add this in your head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @livewireStyles()
    <style>
        :root{
            --primary: #6a1e96;
            --primary-hover: #e3d1ee;
            --primary-text-color: #ffffff;
            --primary-text-hover-color: #44016b;
            --primary-border-color: #290041;
            --primary-outline: #c390e0;
        }
        .btn-primary{
            border-color: var(--primary-border-color);
            color: var(--primary-text-color);
            background-color: var(--primary);
        }
        .btn-primary:hover{
            border-color: var(--primary-border-color);
            color: var(--primary-text-hover-color);
            background-color: var(--primary-hover);
        }
        body {
            overflow-x: hidden;
        }

        .pos-container {
            height: 100vh;
            max-width: 100vw;
            overflow: hidden;
        }

        .row {
            margin-right: 0;
            margin-left: 0;
        }

        .left-panel {
            background: #f8f9fa;
            border-right: 2px solid #dee2e6;
        }

        .product-list {
            height: calc(100vh - 290px);
            overflow-y: auto;
            position: relative;
        }

        .product-list thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            /* Match your left-panel background color */
            z-index: 1;
            border-bottom: 2px solid #dee2e6;
            padding: 0.75rem;
            font-weight: 500;
        }

        .product-list tbody {
            position: relative;
            z-index: 0;
        }

        /* Add this to ensure header stays above scroll content */
        .product-list table {
            border-collapse: separate;
            border-spacing: 0;
        }

        /* Enhanced scroll styling */
        .product-scroll::-webkit-scrollbar,
        .product-grid-container::-webkit-scrollbar {
            width: 3px;
        }

        .product-scroll::-webkit-scrollbar-track,
        .product-grid-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .product-scroll::-webkit-scrollbar-thumb,
        .product-grid-container::-webkit-scrollbar-thumb {
            background: #cfd9ff;
            border-radius: 4px;
        }

        .product-list::-webkit-scrollbar-thumb:hover,
        .product-grid-container::-webkit-scrollbar-thumb:hover {
            background: #7b96ff;
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.1);
        }

        /* Product grid container styling */
        .product-grid-container {
            height: calc(100vh - 170px);
            overflow-x: auto;
            cursor: grab;
        }

        .product-grid-container.dragging {
            cursor: grabbing;
            user-select: none;
        }

        /* Keep totals section fixed at bottom */
        .totals-section {
            background: #f1f1f1;
            padding-top: 1rem;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .product-card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
        }

        .drag-scroll::-webkit-scrollbar {
            display: none;
        }

        .drag-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Dragging cursor feedback */
        .drag-scroll.dragging {
            cursor: grabbing;
            user-select: none;
        }

        .fade-overlay {
            position: absolute;
            top: 0;
            width: 35px;
            height: 100%;
            pointer-events: none;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .btn-outline-primary {
            border-color: #2A4E6C;
            color: #2A4E6C;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-outline) !important;
            color: var(--primary-text-hover-color) !important;
            border-color: var(--primary-border-color) !important;
        }
        .btn-outline-primary:active {
            background-color: var(--primary) !important;
            border-color: var(--primary-border-color) !important;
            color: white !important;
        }

        .btn-link.text-danger:hover {
            color: #6e000b !important;
            scale: 1.03
        }
        .btn-link.text-danger:active {
            color: #ce0015 !important;
            scale: 0.93
        }

        tr:hover {
            background-color: #5f7f9e;
        }

    </style>
</head>

<body>
    <div class="container-fluid pos-container">
        <div class="row h-100">
            <!-- Left Panel (1/3) -->
            <div class="col-md-4 left-panel p-3">
                <!-- Client/Warehouse Selection -->
                @livewire('client-warehouse-selector')

                <!-- Product List -->
                @livewire('product-cart')

                <!-- Totals Section -->
                <div class=" totals-section">
                    @livewire('totals-section')

                    <!-- Action Buttons -->
                    @livewire('cart-actions')

                </div>
            </div>

            <!-- Right Panel (2/3) -->
            <div class="col-md-8 p-3" style="overflow-x: hidden;">
                <!-- Search and Buttons -->
                @livewire('product-search-and-buttons')

                <!-- Categories -->
                @livewire('category-list')

                <!-- Brands -->
                @livewire('brand-list')

                <!-- Products Grid -->
                @livewire('product-grid')

            </div>
        </div>
    </div>
    <script>
        let isDown = false;
        let startX;
        let scrollLeft;

        function handleMouseDown(e) {
            isDown = true;
            const slider = e.currentTarget;
            slider.classList.add('dragging');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        }

        function handleMouseUp(e) {
            isDown = false;
            const slider = e.currentTarget;
            slider.classList.remove('dragging');
        }

        function handleMouseMove(e) {
            if (!isDown) return;
            e.preventDefault();
            const slider = e.currentTarget;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Adjust multiplier for scroll speed
            slider.scrollLeft = scrollLeft - walk;
        }
        // Vertical drag-to-scroll for product list
        // Vertical scrolling functions
        let isDraggingVertical = false;
        let startY;
        let scrollTop;

        function handleMouseDownProduct(e) {
            isDraggingVertical = true;
            const target = e.currentTarget;
            startY = e.pageY - target.getBoundingClientRect().top;
            scrollTop = target.scrollTop;
            target.style.cursor = 'grabbing';
            target.style.userSelect = 'none';
        }

        function handleMouseUpProduct(e) {
            isDraggingVertical = false;
            const target = e.currentTarget;
            target.style.cursor = 'default';
            target.style.userSelect = 'auto';
        }

        function handleMouseMoveProduct(e) {
            if (!isDraggingVertical) return;
            e.preventDefault();
            const target = e.currentTarget;
            const y = e.pageY - target.getBoundingClientRect().top;
            const walk = (y - startY) * 2;
            target.scrollTop = scrollTop - walk;
        }



    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts()
</body>

</html>
