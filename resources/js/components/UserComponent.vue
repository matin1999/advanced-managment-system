<template>
<div class="page-content">
<flash-message transitionIn="animated swing" class="myCustomClass"></flash-message>
        <div class="portlet light ">
            <div class="page-head">
            <div class="page-title">
                <h1>Users</h1>
            </div>
            </div>
            <div class="portlet-title">
                <div id="prefix_14383248406267" class="custom-alerts alert alert-success">Here you can do CRUD actions on users.</div>
            </div>
            <a class="btn green" data-toggle="modal" style="float:right" href="#user_modal" @click="createModal"> + New user </a>
            <div class="modal fade" tabindex="-1" role="dialog"   id="user_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" v-if="!edit">New User</h5>
                            <h5 class="modal-title" v-else>Edit User</h5>
                        </div>
                        <form role="form" method="post" id="user_form" @submit.prevent=" edit? editUser() : createUser()">
                            <div class="modal-body"> 
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input v-if="edit" type="hidden" name="_method" value="put" />
                                    <input v-if="edit" type="hidden" id="user_id_to_edit" />
                                    <div class="form-group">
                                        <label for="labelFirstName">First Name</label>
                                        <input type="text" class="form-control" id="labelFirstName" name="first_name" placeholder="Enter first name" v-model="user.first_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="labelLastName">Last Name</label>
                                        <input type="text" required class="form-control" id="labelLastName" name="last_name" placeholder="Enter last name" v-model="user.last_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="labelEmail">Email</label>
                                        <input type="email" required class="form-control" id="labelEmail" name="email" placeholder="Enter email" v-model="user.email">
                                    </div>
                                    <div class="form-group">
                                        <label for="labelUsername">Username</label>
                                        <input type="text" required class="form-control" id="labelUsername" name="username" placeholder="Enter username" v-model="user.username">
                                    </div>
                                    <div class="form-group" v-if="!edit">
                                        <label for="labelPassword">Password</label>
                                        <input type="password" required class="form-control" id="labelPassword" name="password" placeholder="Enter password" v-model="user.password">
                                    </div>
                                    <div class="form-group" v-else>
                                        <label for="labelPassword">Password</label>
                                        <input type="password" class="form-control" id="labelPassword" name="password" placeholder="Enter password" v-model="user.password">
                                    </div>
                                    <div class="form-group" id="rolediv">
                                        <label for="role" class="control-label">Choose Role</label><br/>
                                        <select class="form-control" id="role" v-model="user.role" title="Choose Role">
                                            <option value="" selected disabled>Select Role...</option>
                                            <option v-for="role in roles" v-bind:key="role.role_id" :data-tokens="role.role_id" :value="role.role_id">{{role.name}}</option>
                                        </select>
                                    </div>      
                                    <div class="form-group" id="leaderdiv" v-if="user.role !=1">
                                        <label for="leader" class="control-label">Choose Leader</label><br/>
                                        <select class="form-control" id="leader" v-model="user.leader" title="Choose Leader">
                                            <option value="" selected disabled>Select Leader...</option>
                                            <option v-for="user in users" v-bind:key="user.user_id" :data-tokens="user.user_id" :value="user.user_id" v-if="user.role_id != 1">{{user.first_name}} {{user.last_name}}</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="submit" id="modal_submit_button" class="btn green" @click="hideModal" v-show="!edit">Create</button>
                                    <button type="submit" class="btn green" v-show="edit" @click="hideModal">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list font-green"></i>
                    <span class="caption-subject font-green bold uppercase">User List</span>
                </div>
                 
            </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th> First Name</th>
                                    <th> Last Name </th>
                                    <th> Username </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th> Team </th>
                                    <th> Modify </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="users && !users.length" class="no-data">
                                    <td colspan="7" class="text-center">Users not found</td>
                                </tr>
                                <tr v-else v-for="user in users" v-bind:key="user.user_id">
                                    <td> {{user.first_name}} </td>
                                    <td> {{user.last_name}} </td>
                                    <td> {{user.username}} </td>
                                    <td> {{user.email}} </td>
                                    <td> {{user.name}} </td>
                                    <td v-if="user.name == 'user'"> 
                                        <a data-toggle="modal" @click="teamModal(user)" href="#team_modal"><i  style="margin-left:10px;" class="icon-users font-green" data-toggle="modal" ></i></a>
                                    </td>
                                    <td v-else>
                                        
                                    </td>
                                    <td> 
                                        <a data-toggle="modal" @click="editModal(user)" href="#user_modal"><i class="icon-pencil font-green" data-toggle="modal" ></i></a> /
                                        <a href="#delete_user_modal" @click="openDeleteModal(user)" data-toggle="modal" style="color:red;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="modal fade" tabindex="-1" role="dialog"   id="delete_user_modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                    <h5 class="modal-title">Delete user "<span id="username"></span>"?</h5>
                                </div>
                                <form role="form" method="post" @submit.prevent="deleteUser">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" id="user_id_to_delete" />
                                    <div class="modal-footer">
                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn red-haze" @click="hideModal">Delete</button>
                                    </div>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" tabindex="-1" role="dialog"   id="team_modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                    <h5 class="modal-title"><span id="user_team"></span>'s team</h5>
                                </div>
                                <form role="form" method="post" @submit.prevent="editTeam">
                                <div class="modal-body">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="_method" value="put" />
                                    <input type="hidden" id="user_id_to_update_team" />
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Team</label>
                                        <select multiple class="form-control" v-model="team">    
                                            <option v-for="user in users" v-bind:key="user.user_id" :data-tokens="user.user_id" :value="user.user_id" v-if="user.role_id != 1">
                                                {{user.first_name}} {{user.last_name}}
                                            </option>
                                        </select>
                                    </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn green" @click="hideModalTeam">Save</button>
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
            test: '1',
            jwt: '',
            users: [],
            user: {
                first_name: '',
                last_name: '',
                email: '',
                username: '',
                password: '',
                role: '',
                leader: ''
            },
            roles: [],
            team: [],
            edit: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    },
    created(){
        $(document).ready(function() {
           // $('.selectpicker').selectpicker();
        });
        this.fetchUsers();
        this.fetchRoles();
        this.jwt = this.$auth;
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
        fetchUsers(){
            let theVue = this;
            axios.get('http://jira-app.com/api/user')
                    .then(response => {this.users = response.data; /*theVue.$nextTick(function(){ $('#team-list').selectpicker('refresh');*/
            });
           
        },
        fetchRoles(){
            axios.get('http://jira-app.com/api/roles')
                    .then(response => {this.roles = response.data});
        },
        createUser(){
            console.log('CREATE');
            axios.post('http://jira-app.com/api/user', {user: this.user})
            .then(response => {this.fetchUsers();});
        },
        editUser(){
            axios.put('http://jira-app.com/api/user/'+this.user.user_id, {user:this.user})
            .then(response => {this.fetchUsers(); console.log(response);this.flash(response.data.msg, response.data.status);});
        },
        deleteUser(){
            axios.delete('http://jira-app.com/api/user/'+this.user.user_id)
            .then(response => {this.fetchUsers();});
        },
        editTeam(){
            var user_id = $('#user_id_to_update_team').val();
            axios.put('http://jira-app.com/api/edit_team/'+user_id, {team: this.team})
            .then(response => {this.fetchUsers(); console.log(response);});
            
        },
        createModal(){
            this.edit = false;
            this.user.first_name = '';
            this.user.last_name = '';
            this.user.email = '';
            this.user.username = '';
            this.user.password = '';
            this.user.role = '';
            this.user.leader = '';
             $('#role').attr('data-placeholder', 'Choose Role');
             $('#leader').attr('data-placeholder', 'Choose Leader');
            $('.filter-option-inner-inner').text('Nothing selected');
        },
        hideModal(){
            $('#user_modal').modal('hide');
            $('#delete_user_modal').modal('hide');
            
            $('.modal-backdrop.in' ).hide(); // removes the overlay
        },
        hideModalTeam(){
            $('#team_modal').modal('hide');
            $('.modal-backdrop.in' ).hide();
        },
        teamModal(user){
            let team_users;
            $('#user_team').text(user.first_name+' '+user.last_name);
            $('#user_id_to_update_team').val(user.user_id);
            axios.get('http://jira-app.com/api/team', {params:{user_id: user.user_id}})
            .then(response => {
                let niz = [];
                $.each(response.data, function( key, value ) {
                    niz.push(value.user_id);
                });
                this.team = niz;
            });
        },
        editModal(user){
            this.edit = true;
            $('#user_id_to_edit').val(user.user_id);
            this.user.user_id = user.user_id;
            this.user.first_name = user.first_name;
            this.user.last_name = user.last_name;
            this.user.email = user.email;
            this.user.username = user.username;
            //this.user.password = user.password;
            this.user.role = user.role_id;
            this.user.leader = user.parent_id;
            var role =  $('#role option[value="'+this.user.role+'"]').text();
            var leader;
            if(this.user.leader == null){
                leader="Choose Leader";
            }
            else{
                leader =  $('#leader option[value="'+this.user.leader+'"]').text();
            }
            $('#rolediv .filter-option-inner-inner').text(role);
            $('#leaderdiv .filter-option-inner-inner').text(leader);
        },
        openDeleteModal(user){
            $('#delete_user_modal').find('.modal-header #username').text(user.first_name+' '+user.last_name);
            $('#user_id_to_delete').val(user.user_id);
            this.user.user_id = user.user_id;
        }
    }
}
</script>