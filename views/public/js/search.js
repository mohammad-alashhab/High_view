$(document).ready(function() {
    $("#search_input").on("keyup", function() { // Change onkeyup to on("keyup")
        var input = $(this).val();

        if (input != "") {
            $.ajax({
                url: "../../../liveSearch.php",
                method: "POST", // Use uppercase for method
                data: { input: input },
                success: function(data) {
                    $("#searchResults").html(data).show(); // Show results when data is returned
                }
            });
        } else {
            $("#searchResults").hide(); // Correct "dispaly" to "hide" and ensure results are hidden when input is empty
        }
    });
});
