const products = document.querySelectorAll('.product-card');
const applyFilterButton = document.getElementById('apply-filter');
const clearFilterButton = document.getElementById('clear-filter');

applyFilterButton.addEventListener('click', () => {
    const selectedCategory = document.getElementById('categories').value;
    const minPrice = parseFloat(document.getElementById('min-price').value) || 0;
    const maxPrice = parseFloat(document.getElementById('max-price').value) || Infinity;

    products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        const productPrice = parseFloat(product.getAttribute('data-price'));

        const isCategoryMatch = selectedCategory ? productCategory === selectedCategory : true;
        const isPriceMatch = productPrice >= minPrice && productPrice <= maxPrice;

        if (isCategoryMatch && isPriceMatch) {
            product.style.display = 'flex';
        } else {
            product.style.display = 'none';
        }
    });
});

clearFilterButton.addEventListener('click', () => {
    document.getElementById('categories').selectedIndex = 0;
    document.getElementById('min-price').value = '';
    document.getElementById('max-price').value = '';
    products.forEach(product => {
        product.style.display = 'flex';
    });
});
