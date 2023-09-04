<template>
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar">
                    <ul v-if="$auth.check() && $auth.user().role_id == 1" class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        
                        <li class="nav-item start">
                            <router-link to="/dashboard" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        <li class="nav-item start">
                            <router-link to="/projects" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">Projects</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        <li class="nav-item start">
                             <router-link to="/users" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Users</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        <li class="nav-item start">
                             <router-link to="/configuration" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Configuration</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                    </ul>
                    <ul v-if="$auth.check() && $auth.user().role_id == 2" class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start">
                            <router-link to="/dashboard" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        <li class="nav-item start">
                            <router-link to="/user_projects" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">Projects</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                        <li class="nav-item start">
                             <router-link to="/tasks" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Tasks</span>
                                <span class="selected"></span>
                            </router-link>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
</template>

<script>
export default {
    data(){
        return {
            authUser: null
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData:function(){
            axios.get('http://jira-app.com/api/company')
                 .then(result => this.company_name = result.data.name);
        }
    }
}
</script>

<style>
    .router-link-active{
        border-left: 3px solid #5C9ACF!important;
        margin-left: -3px;
        padding-left: 15px;
        background: #f2f6f9;
    }
</style>

