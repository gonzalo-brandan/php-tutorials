<?php
$products = [
    ['name' => 'T-shirt', 'color' => 'red', 'size' => 'medium'],
    ['name' => 'Jeans', 'color' => 'blue', 'size' => 'large'],
    ['name' => 'Sweater', 'color' => 'green', 'size' => 'small'],
    ['name' => 'Dress', 'color' => 'red', 'size' => 'small'],
    ['name' => 'Jacket', 'color' => 'blue', 'size' => 'medium'],
];

// Get the selected color and size from the query parameters or set them to empty if not selected
$color = $_GET['color'] ?? '';
$size = $_GET['size'] ?? '';

// Function to check if a value is selected in the dropdowns
function isSelected(string $compare, string $to){
    return $compare === $to ? 'selected' : '';
}

// Filter products based on selected color and size
$filteredProducts = array_filter(
    $products,
    fn(array $product): bool =>
        ($color === '' || $product['color'] === $color) &&
        ($size === '' || $product['size'] === $size)
)
?>

<html>
    <body>
        <h1>Filter Products</h1>
        <form method="GET">
            <!-- Dropdown for size selection -->
            <label>Size:</label>
            <select name="size" id="size">
                <option value="">Any</option>
                <option value="small" <?=isSelected($size, 'small')?>>Small</option>
                <option value="medium" <?=isSelected($size, 'medium')?>>Medium</option>
                <option value="large"<?=isSelected($size, 'large')?>>Large</option>
            </select>
            <!-- Dropdown for color selection -->
            <label>Color:</label>
            <select name="color" id="color">
                <option value="">Any</option>
                <option value="red" <?=isSelected($color, 'red')?>>Red</option>
                <option value="blue" <?=isSelected($color, 'blue')?>>Blue</option>
                <option value="green" <?=isSelected($color, 'green')?>>Green</option>
            </select>
            <button type="submit">Filter</button>
        </form>
        
        <!-- Link to reset the filter -->
        <a href="<?=$_SERVER['PHP_SELF']?>">Reset filter</a>
        <h2>Products</h2>
        <?php if(!empty($filteredProducts)): ?>
        <!-- Display the filtered list of products -->

        <ul>
            <?php foreach($filteredProducts as $product): ?>
                <li>
                    <?=htmlspecialchars($product['name'])?> -
                    <?=htmlspecialchars($product['color'])?>,
                    Size: <?=htmlspecialchars($product['size'])?>
                </li>
            <?php endforeach;?>
        </ul>
        <?php else: ?>
        <!-- Display message if no products match the filter -->
            <p>No products match criteria</p>
        <?php endif;?>
    </body>
</html>