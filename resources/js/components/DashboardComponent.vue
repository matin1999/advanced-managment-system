<template>
<div class="page-content">
    <div class="portlet light">
        <div class="page-head">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
            </div>
        <div class="portlet-title">
            <div id="prefix_1438324840626" class="custom-alerts alert alert-success">Welcome to Jira App!</div>
        </div>
        <div v-if="$auth.check() && $auth.user().role_id == 1">
            Admin
        </div>
        <div v-if="$auth.check() && $auth.user().role_id == 2">
            User
        </div>
    </div>
    </div>
</template>

<script>
export default {
    
    
}
</script>

