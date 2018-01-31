import anime from 'animejs'

export default class Revealer {
  constructor() {
    this.elm = document.querySelector('.revealer-overlays')
    this.path = this.elm.querySelectorAll('path')
    this.title = this.elm.querySelector('.revealer-title-text')
    this.numPoints = 3
    this.layerDuration = 750
    this.titleDuration = 750
    this.delayPointsArray = []
    this.delayPointsMax = 200
    this.delayPerPath = 50
    this.delayTitle = 100
    this.isOpened = false
    this.isAnimating = false
    this.setPaths()
    this.calculateMiddlePath()
  }

  toggle(value) {
    this.reveal(value)
  }

  reveal(value) {
    this.isAnimating = true
    this.setPaths()
    return this.animateLayersIn(value)
  }

  close() {
    this.isOpened = false
  }

  setPaths() {
    this.pointsIn = {}
    this.pointsOut = {}

    this.pointsIn.end = 'M 0 100 C 25 100 25 100 50 100 C 75 100 75 100 100 100 V 0 H 0'
    this.pointsIn.start = 'M 0 0 C 25 0 25 0 50 0 C 75 0 75 0 100 0 V 0 H 0'
    this.pointsOut.start = 'M 100 0 C 75 0 75 0 50 0 C 25 0 25 0 0 0 V 100 H 100'
    this.pointsOut.end = 'M 100 100 C 75 100 75 100 50 100 C 25 100 25 100 0 100 V 100 H 100'

    this.calculateMiddlePath()
  }

  calculateMiddlePath() {
    const range = Math.random() * Math.PI * 2

    for (var i = 0; i < this.numPoints; i++) {
      const radian = i / (this.numPoints - 1) * Math.PI * 2
      this.delayPointsArray[i] = (Math.sin(radian + range) + 1) / 2 * this.delayPointsMax
    }

    const points = []

    // This is to make the path morph more drastically for faster durations
    for (var i = 0; i < this.numPoints; i++) {
      points[i] =
        Math.min(
          Math.max(this.layerDuration / 2 - this.delayPointsArray[i], 0) / this.layerDuration,
          1
        ) * 100
    }

    this.pointsIn.middle = ''
    this.pointsOut.middle = ''

    this.pointsIn.middle += `M 0 ${points[0]} `
    this.pointsOut.middle += `M 100 ${100 - points[0]} `

    for (var i = 0; i < this.numPoints - 1; i++) {
      const p = (i + 1) / (this.numPoints - 1) * 100
      const cp = p - 1 / (this.numPoints - 1) * 100 / 2
      this.pointsIn.middle += `C ${cp} ${points[i]} ${cp} ${points[i + 1]} ${p} ${points[i + 1]} `
    }

    for (var i = 0; i < this.numPoints - 1; i++) {
      const p = (i + 1) / (this.numPoints - 1) * 100
      const cp = p - 1 / (this.numPoints - 1) * 100 / 2
      this.pointsOut.middle += `C ${100 - cp} ${100 - points[i]} ${100 - cp} ${100 -
        points[i + 1]} ${100 - p} ${100 - points[i + 1]} `
    }

    this.pointsIn.middle += `V 0 H 0`
    this.pointsOut.middle += `V 100 H 100`
  }

  /**
   * Perform the animation to cover the page. Returns a promise which resolves
   * when the animation is finished (when entire page is covered).
   *
   * @param preloaderMessage
   * @returns {Promise<any>}
   */
  animateLayersIn(preloaderMessage) {
    return new Promise(resolve => {
      document.querySelectorAll('.revealer-title-text').forEach(r => {
        r.innerHTML = preloaderMessage
      })

      this.path.forEach(p => {
        p.setAttribute('d', this.pointsIn.start)
      })

      let tl_animateLayersIn = anime.timeline({
        complete: function() {
          resolve()
        },
      })

      for (var i = 0; i < this.path.length; i++) {
        tl_animateLayersIn
          .add({
            targets: this.path[i],
            d: [this.pointsIn.start, this.pointsIn.middle],
            duration: this.layerDuration / 2,
            offset: this.delayPerPath * i,
            easing: 'easeInCubic',
          })
          .add({
            targets: this.path[i],
            d: this.pointsIn.end,
            duration: this.layerDuration / 2,
            offset: this.layerDuration / 2 + this.delayPerPath * i,
            easing: 'easeOutCubic',
          })
      }

      tl_animateLayersIn.add({
        targets: '.revealer-title-text',
        translateY: ['100%', '0%'],
        duration: this.titleDuration,
        offset: '-=' + this.delayTitle + '',
        easing: 'easeOutCirc',
      })
    })
  }

  animateLayersOut() {
    const revealer = this

    this.path.forEach(p => {
      p.setAttribute('d', this.pointsOut.start)
    })

    let tl_animateLayersIn = anime.timeline({
      complete: function() {
        revealer.animationFinished()
      },
    })

    tl_animateLayersIn.add({
      targets: '.revealer-title-text',
      translateY: ['0%', '-100%'],
      duration: this.titleDuration,
      easing: 'easeInCirc',
    })

    for (var i = 0; i < this.path.length; i++) {
      tl_animateLayersIn
        .add({
          targets: this.path[i],
          d: [this.pointsOut.start, this.pointsOut.middle],
          duration: this.layerDuration / 2,
          offset:
            this.titleDuration - this.delayTitle + this.delayPerPath * (this.path.length - i - 1),
          easing: 'easeInCubic',
        })
        .add({
          targets: this.path[i],
          d: this.pointsOut.end,
          duration: this.layerDuration / 2,
          offset:
            this.titleDuration -
            this.delayTitle +
            this.layerDuration / 2 +
            this.delayPerPath * (this.path.length - i - 1),
          easing: 'easeOutCubic',
        })
    }
  }

  loadNewContents() {
    let revealer = this

    setTimeout(function() {
      revealer.animateLayersOut()
    }, 1500)
  }

  animationFinished() {
    //revealLinks.removeClass("animating");
    this.isAnimating = false
  }
}
