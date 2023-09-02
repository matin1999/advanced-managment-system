<template>
  <div class="login">
    <flash-message transitionIn="animated swing" class="myCustomClass"></flash-message>
        <div class="content" id="loginForm">
              <!-- BEGIN LOGIN FORM -->
              <div  >
                <div class="alert alert-danger" v-if="error">
                  <p>There was an error, unable to sign in with those credentials.</p>
                </div>
                <form class="login-form" @submit.prevent="login" method="post" >
                    <h3 class="form-title font-green">Log In</h3>
                    <h4 class="form-title font-green text-center">{{company_name}}</h4>
                    
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Username</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" id="username" v-model="username" placeholder="Username" name="username"  required/> </div>
                        <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password" v-model="password" placeholder="Password" name="password" required/> </div>
                        
                      <div class="form-actions">
                        <button type="submit" class="btn green uppercase ">Login</button>
                    </div>
                </form>
                <div class="copyright"> {{ new Date().getFullYear() }} © Powered by Jira.</div>
              </div>
          </div>
        </div>
</template>
<script>
  export default {
    data(){
      return {
        username: null,
        password: null,
        error: false,
        company_name: '',
      }
    },
    created(){
        this.fetchData();
    },  
    methods: {
      fetchData(){
            axios.get('http://jira-app.com/api/info')
                .then(response => 
                {   //console.log(response);
                    this.company_name = response.data.info.company.name;
                    
                });
      },
      login(){
        var app = this
        this.$auth.login({
            params: {
              username: app.username,
              password: app.password
            },
            success: function (data) {console.log(data)},
            error: function (err) {this.error=true;},
            rememberMe: true,
            redirect: '/dashboard',
            fetchUser: true,
        }); 
          
      }
      
    }
   
  } 
  
</script>
<style>
  #loginForm{
    margin: 0 auto;
  }
</style>