export default class Revealer {
  static run() {
    const sticky = document.querySelector('#sticky')
    const stickyElementPos = sticky.getBoundingClientRect()
    const stickyOffset = {
      top: stickyElementPos.top + document.body.scrollTop,
      left: stickyElementPos.left + document.body.scrollLeft,
    }
    const contentDivs = document.querySelectorAll('.component')
    document.addEventListener('scroll', function() {
      contentDivs.forEach(function(el) {
        const _actPosition = el.getBoundingClientRect().top - 40
        const _isLight = el.classList.contains('section-light')
        const _elComputedStyle = getComputedStyle(el, null)
        if (
          _actPosition < stickyOffset.top &&
          _actPosition + parseInt(_elComputedStyle.height) > 0
        ) {
          sticky.classList.remove('menu-white', 'menu-dark')
          sticky.classList.add(_isLight ? 'menu-dark' : 'menu-white')
          document.getElementById('logomaniak').src = _isLight
            ? 'img/logos/maniak/logo-maniak-dark.svg'
            : 'img/logos/maniak/logo-maniak-white.svg'
          return false
        }
      })
    })
  }
}
