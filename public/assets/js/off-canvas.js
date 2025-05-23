(function($) {
  'use strict';
  $(function() {
    $('[data-toggle="offcanvas"]').on("click", function() {
      console.log('Toggle sidebar clicked');
      $('.sidebar-offcanvas').toggleClass('active')
    });
  });
})(jQuery);