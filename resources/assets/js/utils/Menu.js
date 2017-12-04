window.$ = require('jquery');
export default class Revealer {

  static run() {
    var stickyOffset = $("#sticky").offset();
    var $contentDivs = $(".component");
    $(document).scroll(function() {
      $contentDivs.each(function(k) {
        var _thisOffset = $(this).offset();
        var _actPosition = _thisOffset.top - $(window).scrollTop();
        _actPosition = _actPosition - 40;
        if (_actPosition < stickyOffset.top && _actPosition + $(this).height() > 0) {
          $("#sticky").removeClass("menu-white menu-dark").addClass($(this).hasClass("section-light") ? "menu-dark" : "menu-white");
          document.getElementById("logomaniak").src = $(this).hasClass("section-light") ? "img/logos/maniak/logo-maniak-dark.svg" : "img/logos/maniak/logo-maniak-white.svg";
          return false;
        }
      });
    });
  }


}