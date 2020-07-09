<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Admin Panel
                        <span class="float-right">
                            <button v-on:click="newUser()" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">+ New User</button>
                        </span>
                    </div>
<!---------------- Spinner Area START ---------------->
                    <div v-if="users.length == 0 " class="card-body spninner-area">
                        <div class="spinner-grow text-primary spinner-div" role="status">
                            <span class="sr-only spinner-ball">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary spinner-div" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success spinner-div" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
<!---------------- Spinner Area END ---------------->

                    <div v-if="users.length > 0 " class="card-body">
    <!------------ New User Create Section -----START--------->
                        <form @submit.prevent="editMode ? updateUserinfo() :createUser()">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 v-show="!editMode" class="modal-title" id="exampleModalLabel">New User Create</h5>
                                        <h5 v-show="editMode" class="modal-title" id="exampleModalLabel">Update User Infos</h5>
                                        <button v-on:click="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text label-info">Name</span>
                                          </div>
                                          <input v-model="updateUser[0].name" type="text" class="form-control">
                                        </div>

                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text label-info">Email</span>
                                          </div>
                                          <input v-model="updateUser[0].email" type="text" class="form-control">
                                        </div>

                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text label-info">Role</span>
                                          </div>
                                          <select v-model="updateUser[0].user_type" class="form-control">
                                              <option value="1">Admin</option>
                                              <option value="0">Sub-Admin</option>
                                          </select>
                                        </div>

                                        <div v-show="!editMode" class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text label-info">Password</span>
                                          </div>
                                          <input  v-model="updateUser[0].password" type="text" class="form-control">
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button v-on:click="closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        <button v-show="!editMode" type="submit" class="btn btn-primary">Save</button>
                                        <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

        <!------------ New User Create Section ------END-------->

                        <table id="example1" class="table table-bordered table-striped packg-table text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th width="25%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td v-if="user.user_type ==1">Admin</td>
                                    <td v-if="user.user_type ==0">Sub-Admin</td>
                                    <td class="text-center">

                                        <a class="btn btn-primary btn-sm" v-on:click="editUser(user.id)" href="#">
                                          <i class="fas fa-pencil-alt"></i>  Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash"></i>  Delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <!-- <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                </tr> -->
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getAllUsers();
        }, 

        data() {
            return {
                editMode:false,
                updateUser:[{}],
                users:[],
            }
        },

        methods: {
            getAllUsers(){
                axios.get('/all-users')
                .then(({data})=>{
                    this.users = data;
                    this.updateUser = data;
                })
                .catch();
            },
            newUser(){
                var new_user =[];
                new_user[0] = {
                    email:'',
                    name:'',
                    password:'',
                    user_type:''
                };
                this.updateUser= new_user;
            },
            createUser(){
                var userData = this.updateUser;
                axios.post('/create-user',userData).then(()=>{                
                    $('#exampleModal').modal('hide');
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'New User Create Successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                });
            },
            editUser(id){

                this.editMode = true;
                $('#exampleModal').modal('show');

                let userEdit = [];
                for (let i = 0; i < this.users.length; i++) {
                    if (this.users[i].id == id) {
                        userEdit.push(this.users[i],);
                    }
                }
                this.updateUser = userEdit;

                // console.log(id);
            },
            updateUserinfo(){
                var userData = this.updateUser;
                axios.post('/update-user',userData).then(()=>{                
                    $('#exampleModal').modal('hide');
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'User Update Successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                });
            },
            closeModal()
            {
                this.editMode = false;
                this.updateUser[0] = {
                    created_at:'',
                    email:'',
                    email_verified_at:'',
                    id:'',
                    name:'',
                    password:'',
                    remember_token:'',
                    updated_at:'',
                    user_type:''
                };
                $('#exampleModal').modal('hide');
                this.getAllUsers();
            },
        }
    }
</script>
