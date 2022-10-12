<div class="product-slider product-m no-arrow">
    @each('root.components.product-card', $category->products->take(25), 'product')
</div>
