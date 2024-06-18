function convertToSlug(Text) {
    return Text.toLowerCase()
        .replace(/[^\w ]+/g, "")
        .replace(/ +/g, "-");
}

$(document).on("change", ".slug-generator", function () {
    var target = $(this).attr("data-target");
    var value = $(this).val();
    $(target).val(convertToSlug(value));
});
