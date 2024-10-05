$(document).ready(function() {
    // Initially hide the list section
    $('#list').hide();

    // When a menu item is clicked
    $('.sidebar-menu a').on('click', function(e) {
        e.preventDefault(); // Prevent default anchor click behavior

        // Get the target section ID from the href attribute
        var targetSection = $(this).attr('href');

        // Hide all sections
        $('.content-section').hide();

        // Show the target section
        $(targetSection).show();

        // Remove the 'active' class from all menu items
        $('.sidebar-menu a').removeClass('active');

        // Add the 'active' class to the clicked menu item
        $(this).addClass('active');
    });
});
