<template>
    <div class="revealer">
        <svg ref="svg" class="revealer-overlays" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path ref="paths" v-for="path in paths" :d="path.d" class="revealer-overlays__path"></path>
        </svg>
        <div class="revealer-title container text-dark">
            <div class="revealer-grid">
                <h4 ref="revealText" class="revealer-title-text">
                    {{phrase}}
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
    import anime from 'animejs'

    export default {
        props: {
            phrases: {
                type: Array,
                default: () => [
                  'We have an insatiable curiosity for big ideas and love making them happen.',
                  'A controlled kind of crazy with a passion for creative disruption.',
                  'Maniac, [ˈmā-nē-ˌak]: A person characterized by an unbridled enthusiasm for something.',
                  'Thinking about cool transition phrases... 🤔',
                ],
            },
        },

      data() {
            return {
                paths: [
                    {d: 'M 0 100 C 25 100 25 100 50 100 C 75 100 75 100 100 100 V 0 H 0'},
                    {d: 'M 0 100 C 25 100 25 100 50 100 C 75 100 75 100 100 100 V 0 H 0'},
                    {d: 'M 0 100 C 25 100 25 100 50 100 C 75 100 75 100 100 100 V 0 H 0'},
                ],
                pointsIn: {
                    start: 'M 0 0 C 25 0 25 0 50 0 C 75 0 75 0 100 0 V 0 H 0',
                    middle: '',
                    end: 'M 0 100 C 25 100 25 100 50 100 C 75 100 75 100 100 100 V 0 H 0',
                },
                pointsOut: {
                    start: 'M 100 0 C 75 0 75 0 50 0 C 25 0 25 0 0 0 V 100 H 100',
                    middle: '',
                    end: 'M 100 100 C 75 100 75 100 50 100 C 25 100 25 100 0 100 V 100 H 100',
                },
                numPoints: 3,
                phrase: this.getPhrase(this.phrases),
                layerDuration: 750,
                titleDuration: 750,
                delayPointsArray: [],
                delayPointsMax: 200,
                delayPerPath: 50,
                delayTitle: 100,
                isOpened: true,
                isAnimating: false,
            }
        },

        methods: {
            reveal() {
                if (!this.isOpened) {
                    this.isAnimating = true
                    this.phrase = this.getPhrase(this.phrases)
                    this.$emit('revealer-animation-on')
                    this.calculateMiddlePath()
                    this.resetPoints()
                    return this.animateLayersIn()
                }
                return new Promise(resolve => {
                    resolve()
                })
            },

            close() {
                this.isAnimating = true
                this.$emit('revealer-animation-on')
                this.calculateMiddlePath()
                this.resetPoints()
                this.animateLayersOut()
            },

            calculateMiddlePath() {
                const range = Math.random() * Math.PI * 2

                for (let i = 0; i < this.numPoints; i++) {
                    let radian = i / (this.numPoints - 1) * Math.PI * 2
                    this.delayPointsArray[i] = (Math.sin(radian + range) + 1) / 2 * this.delayPointsMax
                }

                const points = []

                // This is to make the path morph more drastically for faster durations
                for (let i = 0; i < this.numPoints; i++) {
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

                for (let i = 0; i < this.numPoints - 1; i++) {
                    let p = (i + 1) / (this.numPoints - 1) * 100
                    let cp = p - 1 / (this.numPoints - 1) * 100 / 2
                    this.pointsIn.middle += `C ${cp} ${points[i]} ${cp} ${points[i + 1]} ${p} ${points[i + 1]} `
                    this.pointsOut.middle += `C ${100 - cp} ${100 - points[i]} ${100 - cp} ${100 -
                    points[i + 1]} ${100 - p} ${100 - points[i + 1]} `
                }

                this.pointsIn.middle += `V 0 H 0`
                this.pointsOut.middle += `V 100 H 100`
            },

            resetPoints() {
                this.paths.map(() => this.pointsIn.start)
            },

            animateLayersIn() {
                return new Promise(resolve => {
                    const tl_animateLayersIn = anime.timeline({
                        complete: () => {
                            this.isOpened = true
                            this.animationFinished()
                            this.$emit('revealer-opened')
                            resolve()
                        },
                    })

                    this.paths.forEach((path, key) => {
                        tl_animateLayersIn
                            .add({
                                targets: path,
                                d: [this.pointsIn.start, this.pointsIn.middle],
                                duration: this.layerDuration / 2,
                                offset: this.delayPerPath * key,
                                easing: 'easeInCubic',
                            })
                            .add({
                                targets: path,
                                d: this.pointsIn.end,
                                duration: this.layerDuration / 2,
                                offset: this.layerDuration / 2 + this.delayPerPath * key,
                                easing: 'easeOutCubic',
                            })
                    })

                    tl_animateLayersIn.add({
                        targets: '.revealer-title-text',
                        translateY: ['100%', '0%'],
                        duration: this.titleDuration,
                        offset: '-=' + this.delayTitle + '',
                        easing: 'easeOutCirc',
                    })
                })
            },

            animateLayersOut() {
                let tl_animateLayersIn = anime.timeline({
                    complete: () => {
                        this.isOpened = false
                        this.animationFinished()
                        this.$emit('revealer-closed')
                    },
                })

                tl_animateLayersIn.add({
                    targets: this.$refs.revealText,
                    translateY: ['0%', '-100%'],
                    duration: this.titleDuration,
                    easing: 'easeInCirc',
                })

                this.paths.forEach((path, key) => {
                    tl_animateLayersIn
                        .add({
                            targets: path,
                            d: [this.pointsOut.start, this.pointsOut.middle],
                            duration: this.layerDuration / 2,
                            offset:
                            this.titleDuration -
                            this.delayTitle +
                            this.delayPerPath * (this.paths.length - key - 1),
                            easing: 'easeInCubic',
                        })
                        .add({
                            targets: path,
                            d: this.pointsOut.end,
                            duration: this.layerDuration / 2,
                            offset:
                            this.titleDuration -
                            this.delayTitle +
                            this.layerDuration / 2 +
                            this.delayPerPath * (this.paths.length - key - 1),
                            easing: 'easeOutCubic',
                        })
                })
            },

            getPhrase(phrases) {
                return phrases[Math.floor(Math.random() * phrases.length)]
            },

            animationFinished() {
                this.isAnimating = false
                this.$emit('revealer-animation-off')
            },
        },

        watch: {
            phrases() {
                this.phrase = this.getPhrase(this.phrases)
            },
        }
    }
</script>
