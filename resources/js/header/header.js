function handleSearch(value) {
    const resetButton = document.getElementById('search_page_reset_label');
    resetButton.style.display = value ? 'block' : 'none';
}

function handleCatalogOpen() {
    document.getElementById('catalogButton').classList.toggle('active');;
    document.getElementById('closeCatalog').classList.toggle('active');
    document.getElementById('openCatalog').classList.toggle('active');
}
