<template>
<div class="page-content">
<flash-message transitionIn="animated swing" class="myCustomClass"></flash-message>
    <div class="portlet light">
        <div class="page-head">
            <div class="page-title">
                <h1>Configuration</h1>
            </div>
            </div>
        <div class="portlet-title">
            <div id="prefix_14383248406261" class="custom-alerts alert alert-success">Here you can configure your company name and sprint properties.</div>
        </div>

        <form method="post" @submit.prevent="activateSprint">
            <input type="hidden" name="_token" :value="csrf">
            <button type="submit" class="btn btn-info">Check active sprints</button>
        </form>
        <br/>
        <form  @submit.prevent="updateInfo" method="POST" role="form">
        <input type="hidden" name="_token" :value="csrf">
        
        <div class="form-group">
            <label for="company_name">Company name</label>
            <input type="text" required class="form-control" id="company_name" name="company_name" placeholder="Enter company name" v-model="info.company_name">
        </div>
        <div class="form-group">
            <label for="sprint_length">Sprint length</label>
            <input type="number" required class="form-control" id="sprint_length" name="sprint_length" placeholder="Enter sprint length" v-model="info.sprint_length">
        </div>
        <div class="form-group">
            <label for="sprint_points">Sprint points</label>
            <input type="number" required class="form-control" id="sprint_points" name="sprint_points" placeholder="Enter sprint points" v-model="info.sprint_points">
        </div>
        <button type="submit" class="btn green">Save</button>
        </form>
    </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            info: {
                company_name: '',
                sprint_length: '',
                sprint_points: ''
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')   
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/info')
                .then(response => 
                {   console.log(response);
                    this.info.company_name = response.data.info.company.name;
                    this.info.sprint_length = response.data.info.sprint.length;
                    this.info.sprint_points = response.data.info.sprint.points;
                    
                });
        },
        updateInfo(){

            const currentObject = this;

            axios.post('http://jira-app.com/api/info_update', {info: currentObject.info})
            .then(function (response) {
                currentObject.flash(response.data.msg, response.data.status);
                //console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        activateSprint(){
            const currentObject = this;
            axios.post('http://jira-app.com/activateSprint')
            .then(function (response) {
                currentObject.flash("Sprints updated successfully", 'success');
                //console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }   
    },
    
}
</script>

