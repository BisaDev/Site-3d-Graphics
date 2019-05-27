<template>
    <div class="studio">
        <section class="studio-header">
            <div class="studio-header-title-container container">
                <div class="appear-after-reveal">
                    <h1 class="studio-header-title">Maniak is a design and technology studio in Guadalajara, Mexico.<br>
                    </h1>
                </div>
                <div class="appear-after-reveal appear-after-reveal-delay">
                    <h1 class="studio-header-subtitle">We build websites, applications and interactive experiences.</h1>
                </div>
            </div>
            <div class="studio-header-button-container container">
                <scroll-button to="#who-we-are" text="Read more"></scroll-button>
            </div>
        </section>
        <image-full class="studio-image-full-1"></image-full>
        <section id="who-we-are" class="studio-who">
            <div class="container">
                <div class="grid">
                    <div class="section-title">
                        <h3>Who we are.</h3>
                    </div>
                    <div class="section-content">
                        <p>
                            Maniak is a design and technology studio made up of a multidisciplinary crew of 40 full-time individuals. We pride ourselves on our ability to attract creative and independent thinkers who are looking for something much more than just a job.
                        </p>
                        <p>
                            Our clients appreciate the personality and spirit of our Team as much as the work they provide.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="studio-where">
            <div class="container">
                <div class="grid">
                    <div class="section-title">
                        <h3>Office space.</h3>
                    </div>
                    <div class="section-content">
                        <p>
                            We are located in Guadalajara, in a cool warehouse / office, with a lot of open space and a patio for our traditional barbecues. </p>
                    </div>
                    <a href="mailto:hello@maniak.co" class="studio-where-callout dark">
                        <p>Interested in working here?</p>
                        <button class="button button-arrow">Drop us a line</button>
                    </a>
                </div>
            </div>
        </section>

        <studio-panorama></studio-panorama>

        <section class="studio-values">
            <div class="container">
                <div class="grid">
                    <div class="section-title">
                        <h3>We believe.</h3>
                    </div>
                    <ul class="studio-values-col-1">
                        <li>
                            <h5>In Quality.</h5>
                            <p>Of code, design, space, people. It's what inspire us to never compromise. </p>
                        </li>
                        <li>
                            <h5>In moving fast.</h5>
                            <p>And iterate as often as possible.</p>
                        </li>
                        <li>
                            <h5>In relationships.</h5>
                            <p>Not clients. We want to know you and have a great time working together.</p>
                        </li>
                    </ul>
                    <ul class="studio-values-col-2">
                        <li>
                            <h5>In details.</h5>
                            <p>They make or break the product. </p>
                        </li>
                        <li>
                            <h5>Ease of use</h5>
                            <p>We like simple stuff, simple is hard.</p>
                        </li>
                        <li>
                            <h5>In experiences.</h5>
                            <p>Design, websites, apps, they are all better when we aim to create an experience.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <studio-portfolio></studio-portfolio>
        <section class="studio-services">
            <div class="container">
                <div class="grid studio-services-department">
                    <div class="section-title">
                        <h3>Design.</h3>
                    </div>
                    <div class="section-content">
                        <p>
                            Our design practice is oriented to solve problems in the web and technology space. We like to deliver continuous and intuitive experiences across all digital mediums.
                        </p>
                        <ul>
                            <li>UX Design</li>
                            <li>UI Design</li>
                            <li>Prototyping</li>
                            <li>Idea Validation</li>
                        </ul>
                    </div>
                </div>
                <div class="grid studio-services-department">
                    <div class="section-title">
                        <h3>Software.</h3>
                    </div>
                    <div class="section-content">
                        <p>
                            We take our code seriously and the technologies we use and promote. We are a mix of developers that are capable of delivering seamless experiences.</p>
                        <ul>
                            <li>PHP / Laravel</li>
                            <li>Python / Django</li>
                            <li>React / VueJs</li>
                            <li>Wordpress / Statamic</li>
                        </ul>
                    </div>
                </div>
                <div class="grid studio-services-department">
                    <div class="section-title">
                        <h3>3D &amp; VR.</h3>
                    </div>
                    <div class="section-content">
                        <p>
                            We aim to deliver high quality 3D content across multiple platforms, to provide a visual aid and an experience of something that might not exist. We like games too.
                        </p>
                        <ul>
                            <li>3D Modeling &amp; Rendering</li>
                            <li>Real time simulations</li>
                            <li>Game Design &amp; Development</li>
                            <li>Interactive Applications</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="studio-clients dark">
            <div class="container">
                <div class="grid">
                    <div class="studio-clients-title section-title">
                        <h3>Some of the clients & partners we have worked with.</h3>
                    </div>
                </div>
                <div class="grid">
                    <ul class="studio-clients-list">
                        <li class="studio-clients-link"><a href="http://attck.com/" target="_blank">ATTCK</a></li>
                        <li class="studio-clients-link"><a href="https://www.butchershop.co/" target="_blank">Butchershop</a></li>
                        <li class="studio-clients-link"><a href="https://ciboglobal.com" target="_blank">Cibo</a></li>
                        <li class="studio-clients-link"><a href="https://www.fluid.com/" target="_blank">Fluid</a></li>
                        <li class="studio-clients-link"><a href="http://wearehathway.com/" target="_blank">Hathway</a></li>
                        <li class="studio-clients-link"><a href="https://www.plateiq.com/" target="_blank">Plate IQ</a></li>
                        <li class="studio-clients-link"><a href="http://www.jtbcustom.com/" target="_blank">JTB Customs</a></li>
                        <li class="studio-clients-link"><a href="https://www.nike.com/mx/es_la/" target="_blank">Nike</a></li>
                        <li class="studio-clients-link"><a href="https://upperplayground.com/" target="_blank">Upper Playground</a></li>
                        <li class="studio-clients-link"><a href="https://sideways-nyc.com/" target="_blank">Sideways</a></li>
                        <li class="studio-clients-link"><a href="https://www.vw.com.mx" target="_blank">Volkswagen</a></li>


                    </ul>
                    <div class="studio-clients-description">
                        <p>
                            While our offices are based in Guadalajara, Mexico, clients, partners and humans from all over the world appreciate the personality and spirit of our team.
                        </p>
                        <ul>
                            <li><img class="icon" src="../../img/icons/white/country-US.svg" alt="">USA</li>
                            <li><img class="icon" src="../../img/icons/white/country-DE.svg" alt="">Germany</li>
                            <li><img class="icon" src="../../img/icons/white/country-NE.svg" alt="">Netherlands</li>
                            <li><img class="icon" src="../../img/icons/white/country-AU.svg" alt="">Australia</li>
                            <li><img class="icon" src="../../img/icons/white/country-MX.svg" alt="">Mexico</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <image-full class="studio-image-full-2 no-margin"></image-full>
    </div>
</template>

<script>
    import apiManiak from '../utils/api'
    import ImageFull from '../components/ImageFull'
    import PageCommon from '../components/PageCommon.vue'
    import StudioPanorama from '../components/studio/StudioPanorama'
    import StudioPortfolio from '../components/studio/StudioPortfolio'
    import ScrollButton from '../components/ScrollButton'


    export default {
        extends: {...PageCommon},

        components: {
            StudioPanorama,
            StudioPortfolio,
            ImageFull,
            ScrollButton,
        },

        mounted() {
            this.updateData()
        },

        methods: {
            updateData() {
                this.setNavTheme(false)
                this.$emit('view-loaded')
            },
        },
    }
</script>
