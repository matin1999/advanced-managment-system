<template>
<div class="page-content">
 <flash-message transitionIn="animated swing" class="myCustomClass"></flash-message>
  <div class="portlet light ">
      <div class="page-head">
        <div class="page-title">
            <h1>Tasks</h1>
        </div>
      </div>
      <div class="portlet-title">
        <div id="prefix_14383248406266" class="custom-alerts alert alert-success">Here you can manipulate with tasks and see list of your tasks as same as list of tasks that you assigned to your team sorted by projects.</div>
    </div>
        <a class="btn green" data-toggle="modal" style="float:right" href="#create_task_modal" @click="createTaskModal()" v-if="isParent!=0"> + New task </a>
        <div class="modal fade" tabindex="-1" role="dialog"   id="create_task_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                
                                <h5 class="modal-title">Create new task</h5>
                            </div>

                        <div class="modal-body">
                            <form role="form" method="post" @submit.prevent="createTask()">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="form-group">
                                    <label for="taskTtitle">Task Title</label>
                                    <input type="text" class="form-control" required id="taskTtitle" name="taskTitle" placeholder="Enter task title" v-model="task.title"/>
                                </div>
                                <div class="form-group">
                                    <label for="taskDesc">Task Description</label>
                                    <textarea required  class="form-control" id="taskDesc" name="taskDesc" placeholder="Enter task description" v-model="task.description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="task_project" class="control-label">Choose Project</label><br/>
                                    <select class="form-control" id="task_project"  v-model="task.project_id">
                                        <option value="" selected disabled>Select project...</option>
                                        <option v-for="project in userProjects" v-bind:key="project.project_id" :data-tokens="project.project_id" :value="project.project_id">{{project.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="taskPoints">Points</label>
                                    <input type="number" class="form-control" required id="taskPoints" name="taskPoints" placeholder="Enter task points" v-model="task.points"/>
                                </div> 
                                <div class="form-group">
                                    <label for="select_task_status_edit">Status</label>
                                    <select class="bs-select form-control " id="select_task_status_edit" disabled v-model="task.status_id">
                                        <option v-for="status in statuses" v-bind:key="status.status_id" :value="status.status_id">
                                             {{status.name}}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="assignedTo">Assigned to</label>
                                    <select class="bs-select form-control " id="assignedTo" v-model="task.user_id">
                                        <option disabled selected value="">Choose employee</option>
                                        <option v-for="user in teamUsers" v-bind:key="user.user_id" :value="user.user_id">
                                            {{user.first_name}} {{user.last_name}}
                                        </option>
                                        <option v-bind:key="$auth.user().user_id" :value="$auth.user().user_id">
                                            {{$auth.user().first_name}} {{$auth.user().last_name}}
                                        </option>
                                    </select>
                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn green" @click="hideModal()">Create</button>
                                </div>
                            </form>   
                        </div>
                     </div>
                  </div>
                </div>
      <div class="portlet-body">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> Your tasks</a>
            </li>
            <li>
                <a href="#tab_1_2" data-toggle="tab"> Your team tasks </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab_1_1">
                <br>
                <select class="bs-select form-control input-small" id="projects" v-model="selectedProject" @change.prevent="changeTasks(selectedProject)">
                    <option value="" selected>All tasks</option>
                    <option v-for="project in userProjects" v-bind:key="project.project_id" :value="project.project_id">
                        {{project.name}}
                    </option>
                </select>
                <br/><br/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Description </th>
                            <th> Assigned by </th>
                            <th class="text-center"> Points </th>
                            <th> Status </th>
                            <th> Modify </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="!tasksByProject.length" class="no-data">
                        <td colspan="4" class="text-center">Tasks not found</td>
                        </tr>
                        <tr v-else v-for="task in tasksByProject" v-bind:key="task.task_id" :class="(task.status_id == 3)? 'cross-row': ''">
                        <td>{{task.title}}</td>
                        <td>{{task.description}}</td>
                        <td>{{task.first_name}} {{task.last_name}}</td>
                        <td class="text-center">{{task.points}}</td>
                        <td>{{task.name}}</td>
                        <td>
                            <a data-toggle="modal" @click="editModal(task)" href="#task_modal_user_edit"><i class="icon-pencil font-green" data-toggle="modal" ></i></a> 
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" tabindex="-1" role="dialog"   id="task_modal_user_edit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            
                            <h5 class="modal-title">Modify task "<span id="task_name"></span>'s" status?</h5>
                        </div>

                        <div class="modal-body">
                        <form role="form" method="post" @submit.prevent="editStatus()">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" id="task_id_to_edit" />
                            <label for="select_task_status_edit">Status</label>
                            <select class="bs-select form-control input-small" id="select_task_status_edit" v-model="selectedStatus">
                                <option v-for="status in statuses" v-bind:key="status.status_id" :value="status.status_id">
                                    {{status.name}}
                                </option>
                            </select>
                           <br/>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn green" @click="hideModal()">Save</button>
                            </div>
                          </form>
                        
                        </div>
                     </div>
                  </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_1_2">
                <br>
                <select class="bs-select form-control input-small" id="projectsParent" v-model="selectedProjectParent" @change.prevent="changeTasksParent(selectedProject)">
                    <option value="" selected>All tasks</option>
                    <option v-for="project in userProjects" v-bind:key="project.project_id" :value="project.project_id">
                        {{project.name}}
                    </option>
                </select>
                <br/><br/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Description </th>
                            <th> Assigned to </th>
                            <th class="text-center"> Points </th>
                            <th> Status </th>
                            <th> Modify </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="!tasksByParent.length" class="no-data">
                        <td colspan="4" class="text-center">Tasks not found</td>
                        </tr>
                        <tr v-else v-for="task in tasksByParent" v-bind:key="task.task_id" :class="(task.status_id == 3)? 'cross-row': ''">
                        <td>{{task.title}}</td>
                        <td>{{task.description}}</td>
                        <td>{{task.first_name}} {{task.last_name}}</td>
                        <td class="text-center">{{task.points}}</td>
                        <td>{{task.name}}</td>
                        <td>
                            <a data-toggle="modal" @click="editModalParent(task)" href="#task_modal_parent_edit"><i class="icon-pencil font-green" data-toggle="modal" ></i></a> 
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" tabindex="-1" role="dialog"   id="task_modal_parent_edit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            
                            <h5 class="modal-title">Modify task</h5>
                        </div>

                        <div class="modal-body">
                        <form role="form" method="post" @submit.prevent="editTaskParent(task)">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group">
                                <label for="taskTtitle">Task Title</label>
                                <input type="text" class="form-control" required id="taskTtitle" name="taskTitle" placeholder="Enter task title" v-model="task.title"/>
                            </div>
                            <div class="form-group">
                                <label for="taskDesc">Task Description</label>
                                <textarea required  class="form-control" id="taskDesc" name="taskDesc" placeholder="Enter task description" v-model="task.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="task_project" class="control-label">Choose Project</label><br/>
                                <select class="form-control" id="task_project"  v-model="task.project_id">
                                    <option v-for="project in userProjects" v-bind:key="project.project_id" :data-tokens="project.project_id" :value="project.project_id">{{project.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="taskPoints">Points</label>
                                <input type="number" class="form-control" required id="taskPoints" name="taskPoints" placeholder="Enter task points" v-model="task.points"/>
                            </div> 
                            <div class="form-group">
                                <label for="select_task_status_edit">Status</label>
                                <select class="bs-select form-control" id="select_task_status_edit" v-model="task.status_id">
                                    <option v-for="status in statuses" v-bind:key="status.status_id" :value="status.status_id">
                                        {{status.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assignedTo">Assigned to</label>
                                <select class="bs-select form-control" id="assignedTo" v-model="task.user_id">
                                    <option v-for="user in teamUsers" v-bind:key="user.user_id" :value="user.user_id">
                                        {{user.first_name}} {{user.last_name}}
                                    </option>
                                    <option v-bind:key="$auth.user().user_id" :value="$auth.user().user_id">
                                            {{$auth.user().first_name}} {{$auth.user().last_name}}
                                        </option>
                                </select>
                            </div>
                           <br/>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn green" @click="hideModal()">Save</button>
                            </div>
                          </form>
                        
                        </div>
                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>  
</template>

<script>
export default {
    data(){
        return{
            task:{
                id: '',
                title: '',
                description: '',
                project_id:'',
                status_id: '',
                user_id: '',
                parent_id: '',
                points: '',
                sprint_id: ''
            },
            active_sprint_id: '',
            userProjects: [],
            tasksByProject: [],
            tasksByParent: [],
            statuses: [],
            teamUsers: [],
            selectedProject: '',
            selectedProjectParent: '',
            selectedStatus: '',
            isParent: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    },
    props: {
        projectId: {
            default: ''
        }
    },
    watch: { 
        projectId: function(newVal, oldVal) { // watch it
            this.selectedProject = newVal;
            this.changeTasks();
        }
    },
    created(){
        this.fetchData();
        this.checkParent();
    },
    methods:{
        fetchData(){
            axios.get('http://jira-app.com/api/projects_by_user', {params:{id:this.$auth.user().user_id}})
                 .then(response => this.userProjects = response.data);

            axios.get('http://jira-app.com/api/tasks_by_project', {params:{user_id:this.$auth.user().user_id, project_id: 0}})
                 .then(response => {console.log(response.data);this.tasksByProject = response.data});

            axios.get('http://jira-app.com/api/tasks_by_parent', {params:{user_id:this.$auth.user().user_id, project_id: 0}})
                 .then(response => this.tasksByParent = response.data);

            axios.get('http://jira-app.com/api/statuses')
                 .then(response => this.statuses = response.data);
            axios.get('http://jira-app.com/api/active_sprint')
                 .then(response => this.active_sprint_id = response.data.sprint_id);
        },
        checkParent(){
            axios.get('http://jira-app.com/api/check_parent', {params:{user_id:this.$auth.user().user_id}})
                 .then(response => {this.isParent = response.data.length; });
        },
        changeTasks(){
            axios.get('http://jira-app.com/api/tasks_by_project', {params:{user_id:this.$auth.user().user_id, project_id: this.selectedProject}})
                 .then(response => {this.tasksByProject = response.data});
        },
        changeTasksParent(){
            axios.get('http://jira-app.com/api/tasks_by_parent', {params:{user_id:this.$auth.user().user_id, project_id: this.selectedProjectParent}})
                 .then(response => this.tasksByParent = response.data);
        },
        createTaskModal(){
            this.task.id = '';
            this.task.title = '';
            this.task.description = '';
            this.task.project_id = '';
            this.task.status_id = 1;
            this.task.user_id = '';
            this.task.parent_id = this.$auth.user().user_id;
            this.task.points = '';
            this.task.sprint_id = this.active_sprint_id;
            this.getTeamUsers();
        },
        editModal(task){
            $('#task_name').text(task.title);
            $('#task_id_to_edit').val(task.task_id);
            this.selectedStatus = task.status_id;
        },
        editModalParent(task){
            this.task.id = task.task_id;
            this.task.title = task.title;
            this.task.description = task.description;
            this.task.project_id = task.project_id;
            this.task.status_id = task.status_id;
            this.task.user_id = task.user_id;
            this.task.parent_id = this.$auth.user().user_id;
            this.task.points = task.points;
            this.task.sprint_id = task.sprint_id;
            this.getTeamUsers();
            //console.log(this.task);
        },
        createTask(){
            axios.post('http://jira-app.com/api/create_task', {params:{task:this.task}})
                            .then(response => {console.log(response); this.fetchData();});
        },
        editTaskParent(task){
            axios.put('http://jira-app.com/api/edit_task', {params:{task:this.task}})
                 .then(response => {this.fetchData();});
        },
        getTeamUsers(){
            axios.get('http://jira-app.com/api/team_users', {params:{user_id:this.$auth.user().user_id}})
                 .then(response => {console.log(response); this.teamUsers = response.data});
        },
        editStatus(){
            axios.put('http://jira-app.com/api/edit_status', {params: {task_id: $('#task_id_to_edit').val(), status_id: this.selectedStatus}})
            .then(response => {this.fetchData();});
        },
        hideModal(){
            $('#task_modal_user_edit').modal('hide');
            $('#create_task_modal').modal('hide');
            $('#task_modal_parent_edit').modal('hide');
            $( '.modal-backdrop.in' ).hide(); // removes the overlay
        }
        
    }
}
</script>
<style>
    .cross-row{
        text-decoration:line-through;
    }
    .disable-modification{
        color: currentColor;
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
    }
</style>