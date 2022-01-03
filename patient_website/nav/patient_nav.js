$(document).ready(function() {

  /* Navigation */
  $('.responsive-menu').click(function(e) {
    e.preventDefault();
    $('header nav').slideToggle();
  }); /* END - JS nav slide toggle */

  /*** Remove inline styles at media queries ***/
  $(window).resize(function() {
    if (window.innerWidth > 640) {
      $("header nav").removeAttr("style");
    }
  }); /* END - JS to remove inline styles to nav */

}); /* END - doc.ready */