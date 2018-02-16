<template>
    <div id="form-wrapper" class="container">
        <div class="row">
            <div class="large-12 columns">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form v-on:submit.prevent="login" class="form-horizontal" method="POST" action="">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input v-model="user" id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                    <span class="help-block">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control" name="password" required>


                                    <span class="help-block">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>

                            <!-- @todo Enable remember me on login form
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <!-- @todo Implement forgotten password on login form
                                    <a class="btn btn-link" href="">
                                        Forgot Your Password?
                                    </a>
                                    -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import apiManiak from '../../utils/api'
import cookies from '../../utils/cookies'

export default {
  props: {
    reveal: {
      default: false,
      type: Boolean,
    },
  },

  components: {},

  data() {
    return {
      user: '',
      password: '',
    }
  },

  methods: {
    login(e) {
      let data = {
        user: this.user,
        password: this.password,
      }

      apiManiak.login(data).then(response => {
        cookies.setItem('credentials', JSON.stringify(response.data))
        this.$root.credentials = cookies.getItem('credentials')
        this.$root.isLoggedIn = true
        this.$router.push({ name: 'admin' })

        axios
          .get('api/v1/user', {
            headers: {
              Accept: 'application/json',
              Authorization: 'Bearer ' + JSON.parse(cookies.getItem('credentials')).access_token,
            },
            //credentials: 'include',
          })
          .then(response => {
            this.$root.user = response.data[0]
            cookies.setItem('user', JSON.stringify(this.$root.user))
          })
      })
    },
  },
}
</script>
