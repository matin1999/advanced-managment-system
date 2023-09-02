<template>
<div class="page-content">
<flash-message transitionIn="animated swing" class="myCustomClass"></flash-message>
<div class="portlet light ">
            <div class="page-head">
              <div class="page-title">
                  <h1>Projects</h1>
              </div>
            </div>
            <div class="portlet-title">
                <div id="prefix_14383248406263" class="custom-alerts alert alert-success">Here you can see projects you are on.</div>
            </div>
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Project List</span>
                </div>
            </div>
            <div class="portlet-body">
              <div class="table-scrollable">
                <table class="table table-hover">
                  <thead>
                      <tr>
                        <th> Project Name</th>
                        <th> Project Description </th>
                        <th> Start Date </th>
                        <th class="text-center"> Tasks </th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr v-if="!userProjects.length" class="no-data">
                      <td colspan="5" class="text-center">Projects not found</td>
                    </tr>
                    <tr v-else v-for="project in userProjects" v-bind:key="project.project_id" data-toggle="collapse" v-bind:data-target="'#collapse'+project.project_id">
                      <td> {{project.name}} </td>
                      <td> {{project.description}} </td>
                      <td> {{project.start_date.split(' ')[0]}} </td>
                      <td class="text-center"><router-link :to="{ name: 'tasks', params: { projectId: project.project_id }}"><i class="icon-list font-green"></i></router-link></td>
                      <br>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="modal fade" tabindex="-1" role="dialog"   id="tasks_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Tasks by "<span id="project_name_tasks"></span>" project </h5>
                    </div>
                    <div class="modal-body">
                      <table class="table table-hover">
                        <thead>
                            <tr>
                              <th> Title </th>
                              <th> Assigned by </th>
                              <th class="text-center"> Points </th>
                              <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr v-if="!tasksByProject.length" class="no-data">
                            <td colspan="4" class="text-center">Tasks not found</td>
                          </tr>
                          <tr v-else v-for="task in tasksByProject" v-bind:key="task.task_id">
                            <td>{{task.title}}</td>
                            <td>{{task.first_name}} {{task.last_name}}</td>
                            <td class="text-center">{{task.points}}</td>
                            <td>{{task.name}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                      <div class="modal-footer">
                          <a href="/tasks" class="nav-link nav-toggle" style="float:left"> More tasks... </a>
                          <router-link to="/tasks" class="nav-link nav-toggle" style="float:left">Router link...</router-link>
                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div> -->
          </div>
      </div>
  </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            userProjects: []
        }
    },
    created(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/projects_by_user', {params:{id:this.$auth.user().user_id}})
                 .then(response => this.userProjects = response.data);
        }
    }
}
</script>
