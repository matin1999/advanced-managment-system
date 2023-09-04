<template>
    <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top" v-if="$auth.check()">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <div class="page-logo">
                    <a href="/" style="color:#fff; text-decoration:none"><h3>{{company_name}}</h3></a>
                </div>
                <div class="page-top" >
                    <ul>
                        <li v-if="$auth.check()" class="pull-right"  style="text-align: center;">
                            {{$auth.user().first_name}} {{$auth.user().last_name}}
                            <a href="" class="btn" @click="logout()">Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
</template>
<script>
export default {
    data(){
        return {
            authUser: null,
            company_name: ''
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData:function(){
            axios.get('http://jira-app.com/api/company')
                 .then(result => this.company_name = result.data.name);
        },
        logout(){
            this.$auth.logout({
                redirect: '/login'
            })
        }
    }
}
</script>
<style>
    .page-top i{
        color: #c0cddc;
        font-size: 26px;
        margin-left:70%;
        
    }
    .page-top li{
        list-style-type:none;
        color: #c0cddc;
        font-size: 20px;
    }
    .page-top ul{
        margin-top:5%;
        margin-left:7%;
    }
    .page-top a{
        text-decoration:none;
        color:#c0cddc;
        margin-left: 35px;
    }
    .page-top a:hover{
        text-decoration:none;
        color:#abe7ed;
    }
    
</style>