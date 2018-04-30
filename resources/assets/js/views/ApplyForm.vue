<template>
    <div class="apply">
        <!-- Hero -->
        <themed-section
            :color="'#FFF'"
            :image="null"
            :isDark="true"
            :class="['apply-header', 'align-center', 'no-padding']"
        >
            <div class="apply-header-title-container container">
                <div class="appear-after-reveal">
                    <div class="apply-header-emoji">
                        <p>😱</p>
                    </div>
                    <h3 class="apply-header-title">
                        You're one step closer!
                    </h3>
                    <p> Let us Know you better.</p>
                </div>
            </div>
        </themed-section>

        <!-- Apply Form -->
        <section id="apply-form" class="apply-form">
            <div class="grid-container" v-if="messages">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4 large-offset-4">
                        <p class="apply-form-msg text-center">
                            {{messages}}
                        </p>
                    </div>
                </div>
            </div>
            <form v-on:submit.prevent="sendForm" novalidate="true">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4 large-offset-4">
                            <label>Name *
                                <span class="apply-form-error" v-show="errors.name">{{errorMessage}}</span>
                                <input type="text" placeholder="Need it." v-model="form.name" maxlength="191">
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <label>Email *
                                <span class="apply-form-error" v-show="errors.email">{{errorMessage}}</span>
                                <input type="text" placeholder="Yup, we need it too." v-model="form.email" maxlength="191">
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <label>
                                Add a cover letter or anything you want to share
                                <span :class="['apply-textbox-counter', {'limit-reach' : maxReached}]">
                                    {{wordCount}}/{{maxChars}}
                                </span>
                                <textarea placeholder="Be creative." v-model="form.message" v-bind:maxlength="maxChars"></textarea>
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <label>Do you have a Github or Bitbucket profile?
                                <input type="text" placeholder="Drop it here." v-model="form.profile" maxlength="191">
                            </label>
                        </div>

                        <div class="cell small-12 large-4  large-offset-4">
                            <label>
                                Upload your resume *
                                <span class="apply-form-error" v-show="errors.files">{{errorMessage}}</span>
                            </label>
                            <div class="apply-form-upload-box">
                                <file-upload
                                    class="btn btn-primary"
                                    :multiple="false"
                                    :drop="true"
                                    :drop-directory="true"
                                    @input-filter="inputFilter"
                                    v-model="files"
                                    ref="upload"
                                >
                                    <ul v-if="files.length">
                                        <li v-for="(file, index) in files" :key="file.id">
                                            <span>File name: {{file.name}}</span>
                                            <br />
                                            <span>Size: {{file.size | formatSize}}</span>
                                            <span v-if="file.error">{{file.error}}</span>
                                            <span v-else-if="file.success">success</span>
                                            <span v-else-if="file.active">active</span>
                                            <span v-else></span>
                                        </li>
                                    </ul>
                                    <div v-if="!files.length">
                                        <i class="fa fa-plus"></i>Drag and drop your file here or <span class="">select from your computer</span>
                                    </div>
                                </file-upload>
                            </div>
                            <span class="apply-form-max-size">Max. file size 10mb. File types allowed: pdf, doc, jpg, jpeg, png.</span>
                        </div>

                        <div class="cell small-12 large-4  large-offset-4">
                            <div class="apply-now-container">
                                <button class="apply-now-button" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</template>

<script>
    import apiManiak from '../utils/api.js'
    import ThemedSection from '../components/ThemedSection'
    import pageCommon from '../components/PageCommon'
    import FileUpload from 'vue-upload-component'

    export default {
        extends: {...pageCommon},

        props: {
            reveal: {
                default: false,
                type: Boolean,
            },
            query: {
                default: false,
                type: String,
            }
        },

        components: {
            ThemedSection,
            FileUpload,
        },

        filters: {
            formatSize: size => {
                let format = ''

                switch(true) {
                    case (size < 1024):
                        format = (size / 1024).toFixed(2) + ' B'
                        break;
                    case (size >= 1024 && size < (1024 * 1024)):
                        format = (size / 1024).toFixed(2) + ' KB'
                        break;
                    case (size > (1024 * 1024)):
                        format = (size / 1024 / 1024).toFixed(2) + ' MB'
                        break;
                    default:
                        break;
                }

                return format
            }
        },

        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    profile: '',
                    message: '',
                },
                maxChars: 500,
                messages: '',
                files: [],
                errors: {
                    name: false,
                    email: false,
                    files: false,
                },
                errorMessage: 'This field is required.',
                isSubmitting: false,
            }
        },

        mounted() {
            if (!this.positionExists()) {
                this.$emit('not-found')
            }

            this.setNavTheme(false)
            this.$emit('view-loaded')
        },

        computed: {
            wordCount: function () {
                return this.form.message.length
            },
            maxReached: function () {
                return this.wordCount === this.maxChars
            }
        },

        methods: {
            inputFilter(newFile, oldFile, prevent) {
                if (((newFile.size/1024)/1024) > 10) {
                    alert('Max. file size 10mb.')
                    return prevent()
                }

                // Will not be added to files
                if (!/\.(pdf|doc|docx|jpeg|jpg|png)$/i.test(newFile.name)) {
                    alert('File types allowed: pdf, doc, jpg, jpeg, png.')
                    return prevent()
                }
            },
            sendForm() {
                this.messages = ''
                this.errors.name = !this.form.name.trim().length
                this.errors.email = !this.validEmail(this.form.email)
                this.errors.files = !this.files.length

                if (this.errors.name || this.errors.email || this.errors.files) {
                    this.scrollTop()

                    return false;
                }

                //Avoid Multiple submissions at once
                if (this.isSubmitting) {
                    return false;
                }

                this.isSubmitting = true

                const data = new FormData();

                data.append("name", this.form.name);
                data.append("email", this.form.email);
                data.append("comments", this.form.message);
                data.append("code_profile", this.form.profile);
                data.append("position", this.query);
                data.append("file", this.files[0].file);

                apiManiak
                    .sendApplyForm(data)
                    .then(response => {
                        if (response.data.success) {
                            this.$router.push({ name: 'thanks', params: { phrases: ['Awesome!'], loaded: true}})
                        }

                        this.isSubmitting = false
                    })
                    .catch(error => {
                        this.messages = 'Server Error! Please Try Again Later.'
                        this.scrollTop()
                        this.isSubmitting = false
                    })
            },
            validEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                return re.test(email);
            },
            scrollTop() {
                return window.scrollTo({
                    'behavior': 'smooth',
                    'top': this.$el.querySelector('#apply-form').offsetTop - 80
                })
            },
            positionExists() {
                //@todo change to a Api call (should return array of positions from Profile Model)
                return (['3d', 'backend', 'design', 'frontend',].indexOf(this.query) !== -1)
            }
        },
    }
</script>