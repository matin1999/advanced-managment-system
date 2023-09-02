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
                <div id="prefix_14383248406264" class="custom-alerts alert alert-success">Here you can do CRUD actions on projects.</div>
            </div>
            <a class="btn green" data-toggle="modal" style="float:right" href="#project_modal" @click="createModal"> + New project </a>
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Project List</span>
                </div>
                 <div class="modal fade" tabindex="-1" role="dialog"   id="project_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" v-if="!edit">New Project</h5>
                            <h5 class="modal-title" v-else>Edit Project</h5>
                            
                        </div>
                        <form role="form" method="post" id="project_form" @submit.prevent=" edit? editProject() : createProject()">
                            <div class="modal-body"> 
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input v-if="edit" type="hidden" name="_method" value="put" />
                                    <input v-if="edit" type="hidden" id="project_id_to_edit" />
                                    <div class="form-group">
                                        <label for="labelProjectName">Project Name</label>
                                        <input type="text" required class="form-control" id="labelProjectName" name="project_name" placeholder="Enter project name" v-model="project.project_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="labelProjectDesc">Project Description</label>
                                        <textarea class="form-control" required id="labelProjectDesc" name="project_description" placeholder="Enter project description" v-model="project.project_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelStartDate">Start Date</label>
                                        <input type="date" required  class="form-control" id="labelStartDate" name="start_date" size="16"  v-model="project.start_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="labelEndDate">End Date</label>
                                        <input type="date" required  class="form-control" id="labelEndDate" name="end_date" size="16"  v-model="project.end_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="multiple_user" class="control-label">Choose Employees</label><br/>
                                        <select class="form-control" id="multiple_user" multiple  v-model="selectedUsers">
                                            <option v-for="user in users" v-bind:key="user.user_id" :data-tokens="user.user_id" :value="user.user_id" v-if="user.role_id != 1">{{user.first_name}} {{user.last_name}}</option>
                                        </select>
                                    </div>     
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn green" @click="hideModal" v-show="!edit">Create</button>
                                    <button type="submit" class="btn green" @click="hideModal" v-show="edit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                    <th> End Date </th>
                                    <th> Modify </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!projects.length" class="no-data">
                                    <td colspan="5" class="text-center">Projects not found</td>
                                </tr>
                                <tr v-else v-for="project in projects" v-bind:key="project.project_id">
                                    <td> {{project.name}} </td>
                                    <td> {{project.description}} </td>
                                    <td> {{project.start_date.split(' ')[0]}} </td>
                                    <td> {{project.end_date.split(' ')[0]}} </td>
                                    <td> 
                                        <a data-toggle="modal" @click="editModal(project)" href="#project_modal"><i class="icon-pencil font-green" data-toggle="modal" ></i></a> /
                                        <a href="#delete_project_modal" @click="openDeleteModal(project)" data-toggle="modal" style="color:red;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                         <div class="modal fade" tabindex="-1" role="dialog"   id="delete_project_modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                    <h5 class="modal-title">Delete project "<span id="project_name"></span>"?</h5>
                                </div>
                                <form role="form" method="post" @submit.prevent="deleteProject">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" id="project_id_to_delete" />
                                    <div class="modal-footer">
                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn red-haze" @click="hideModal">Delete</button>
                                    </div>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix margin-bottom-20"> </div>
            </div>
        </div>
        </div>
</template>

<script>
import { promised } from 'q';
export default {
    head: {
        script: [
            { src: 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js' },
        ]
    },
    data(){
        return{
            test: 1,
            projects: [],
            project: {
                project_name: '',
                project_description: '',
                start_date: '',
                end_date: '',
                usersByProject: []
            },
            users: [],
            selectedUsers: [],
            edit: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    },
    created(){
        this.fetchProjects();
        this.fetchUsers();
    },
    watch:{
        $route (to, from){
            this.rerender();
        }
    },
    methods:{
        rerender(){
            //location.reload();
        },
        fetchProjects(){
            axios.get('http://jira-app.com/api/project')
                    .then(response => { this.projects = response.data['data'];});
        },
        fetchUsers(){
            axios.get('http://jira-app.com/api/user')
                    .then(response => this.users = response.data);
        },
        createProject(event){
            //this.selectedUsers = $("#multiple").val();
            axios.post('http://jira-app.com/api/project', {project: this.project, selectedUsers: this.selectedUsers})
            .then(response => {this.fetchProjects();});
        },
        editProject(){
            axios.put('http://jira-app.com/api/project/'+this.project.project_id, {project:this.project, selectedUsers: this.selectedUsers})
            .then(response => {this.fetchProjects();});
        },
        deleteProject(){
            axios.delete('http://jira-app.com/api/project/'+this.project.project_id,)
            .then(response => {this.fetchProjects();});
        },
        hideModal(){
            $('#project_modal').modal('hide');
            $('#delete_project_modal').modal('hide');
            $( '.modal-backdrop.in' ).hide(); // removes the overlay
        },
        createModal(){
            this.edit = false;
            this.project.project_name = '';
            this.project.project_description = '';
            this.project.start_date = '';
            this.project.end_date = '';
            this.selectedUsers = [];
            $('#multiple').attr('data-placeholder', 'Choose Employee');
            $('.filter-option-inner-inner').text('Nothing selected');
        },
        openDeleteModal(project){
            $('#delete_project_modal').find('.modal-header #project_name').text(project.name);
            $('#project_id_to_delete').val(project.project_id);
            this.project.project_id = project.project_id;
        },
        editModal(project){
            this.edit = true;
            $('#project_id_to_edit').val(project.project_id);
            this.project.project_id = project.project_id;
            this.project.project_name = project.name;
            this.project.project_description = project.description;
            this.project.start_date = project.start_date.split(' ')[0];
            this.project.end_date = project.end_date.split(' ')[0];
            var niz = [];
            var inner = '';
            axios.get('http://jira-app.com/api/users_by_project', {params: {project_id: project.project_id}})
            .then(response => {
                //console.log(response.data)

                 $.each(response.data, function( key, value ) {
                    niz.push(value.user_id);
                    //inner += value.first_name+' '+value.last_name+', ';
                 });
                this.selectedUsers = niz;
                // if(niz.length == 0){
                //     inner = 'Nothing selected';
                // }else{
                // inner = inner.substring(0, inner.length - 2);
                // }
                // $('.filter-option-inner-inner').text(inner);
            });

            
        }
        
    }
}
</script>