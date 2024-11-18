<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Variable to store the selected filter
        var searchText = "";

        // Function to apply the filter and show the updated results
        function applyFilter() {
        // Hide all rows in the table
        $('#myTable1 tbody tr').hide();

        // Hide the "No results found" message (if it exists)
        $('#noResultsRow').remove();

        // Filter by text
        var matchingRows = $('#myTable1 tbody tr').filter(function() {
            var rowText = $(this).text().toLowerCase();
            return rowText.includes(searchText);
        });

        if (matchingRows.length > 0) {
            // Show the rows that match the filter
            matchingRows.show();
        } else {
            // Display the "No results found" message
            $('#myTable1 tbody').append('<tr id="noResultsRow"><td colspan="12">No se encontraron resultados</td></tr>');
        }
        }

        // Text change event
        $('#myInput').on('keyup', function() {
        searchText = $(this).val().toLowerCase();
        applyFilter();
        });
            // Date change event
            $('#dateFilter').on('change', function() {
                selectedDate = $(this).val();
                applyFilters();
            });
    });

</script>
