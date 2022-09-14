$(document).ready(function() {

    // for +
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + ' Kyats');
        finalCostCalculation();
    })

    // for -
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + ' Kyats');
        finalCostCalculation();
    })

    // for X (remove)
    $('.btnRemove').click(function() {
        $parentNode = $(this).parents("tr");
        $parentNode.remove();
        finalCostCalculation();
    })

    // functions
    function finalCostCalculation() {
        $finalTotal = 0;
        $('#dataTable tr').each(function(index, row) {
            $finalTotal += Number($(row).find('#total').text().replace("Kyats", ""));
        })

        $('#subTotalPrice').html(`${$finalTotal} Kyats`)
        $('#finalPrice').html(`${$finalTotal+3000} Kyats`)
    }

})