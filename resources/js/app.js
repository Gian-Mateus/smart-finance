import './bootstrap';

function formatCurrency(input) {
    let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
    value = value.replace(/(\d)(\d{2})$/, '$1,$2'); // Add comma before the last 2 digits (cents)
    value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Add period for thousands separator

    input.value = value;
}