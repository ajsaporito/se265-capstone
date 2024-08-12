$(document).ready(function () {
  let dropdownVisible = false;

  // Toggle dropdown menu when clicking its button
  $('#dropdownMenuButton').on('click', function (e) {
    e.stopPropagation();

    if (!dropdownVisible) {
      dropdownVisible = true;
      const offset = $(this).offset();
      const height = $(this).outerHeight();
      const width = $(this).outerWidth();

      const dropDownstyle = {
        top: offset.top + height + 'px',
        left: offset.left + width - $('.dropdown-menu').outerWidth() + 'px'
      };

      $('.dropdown-menu').css(dropDownstyle).appendTo('#searchForm').show();
    } else {
      dropdownVisible = false;
      $('.dropdown-menu').hide().appendTo($(this).parent());
    }
  });

  // Hide dropdown menu when window is resized
  $(window).on('resize', function () {
    dropdownVisible = false;
    $('.dropdown-menu').hide().appendTo($('#dropdownMenuButton').parent());  
  });

  // Hide dropdown menu when clicking anywhere on window
  $(document).on('click', function () {
    dropdownVisible = false;
    $('.dropdown-menu').hide().appendTo($('#dropdownMenuButton').parent());
  });

  // Handle item selection
  $('.dropdown-menu').on('click', '.dropdown-item', function (e) {
    dropdownVisible = false;
    e.preventDefault();
    $('.dropdown-item').removeClass('active');
    $(this).addClass('active');

    // Update placeholder text based on the selected item
    const selectedText = $(this).text();
    let placeholderText = '';

    if (selectedText === 'Search for Jobs') {
      placeholderText = 'Search for jobs...';
    } else if (selectedText === 'Search for People') {
      placeholderText = 'Search for people...';
    } 

    $('#searchBox').attr('placeholder', placeholderText).val('');
    $('.dropdown-menu').hide().appendTo($('#dropdownMenuButton').parent());
  });

  $('#searchBox').on('keyup', function (e) {
    let search = $(this).val();

    if (search !== '') {
      $.ajax({
        url: '/se265-capstone/search',
        type: 'POST',
        data: { search: search },
        success: function(response) {
          $('#searchResults').removeClass('d-none');
          $('#searchResults').html(response);
        },
        error: function(xhr, status, error) {
          console.log('Status: ' + status);
          console.log('Error: ' + error);
          console.log('Response Text: ' + xhr.responseText);
        }
      });
    } else {
      $('#searchResults').css('display', 'none');
    }
  });
});
