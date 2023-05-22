var product = {
    slugify: function (string) {
        return string
            .toString()
            .trim()
            .toLowerCase()
            .replace(/\s+/g, "-")
            .replace(/[^\w\-]+/g, "")
            .replace(/\-\-+/g, "-")
            .replace(/^-+/, "")
            .replace(/-+$/, "");
    },
}

$('#productName').keyup(function () {
    var slug = product.slugify($(this).val());
    $('#txtSlug').val(slug);
    // }
});

$(function (){
    if(productSuccessMsg){
        alert('sadf');
        messages.saved("Product", productSuccessMsg);
    }
    if(productErrorMsg){
        messages.error("Product", productErrorMsg);
    }
});
