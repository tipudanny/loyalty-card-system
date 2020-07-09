<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">                    
                    <div class="card-header">Packages 
                        <span class="float-right">
                            <button class="btn btn-sm btn-success" v-on:click="addModePackage()">+ New Package</button>
                        </span>
                    </div>

<!---------------- Spinner Area START ---------------->
                    <div v-if="packages_name.length == 0 " class="card-body spninner-area">
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
                    <div v-if="isEmpty.length == 0 " class="spninner-area mt-3">
                        <p>No Data Found</p>
                    </div>
<!---------------- Spinner Area END ---------------->

                    <div v-if="packages_name.length > 0 " class="card-body">
                        
                        <table id="example1" class="table table-bordered table-striped packg-table text-center">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Package Name</th>
                                    <th>Status</th>
                                    <th width="25%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(module,index) in packages_name">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ module.p_name }}</td>
                                    <td class="packg-en" v-if="module.p_status == 1">Enable</td>
                                    <td class="packg-de" v-if="module.p_status == 0">Disable</td>
                                    <td class="text-center">

                                        <a class="btn btn-primary btn-sm" v-on:click="editModePackage(module.p_id)" href="#">
                                          <i class="fas fa-pencil-alt"></i>  Edit
                                        </a>
                                        <a v-if="admin == 1" class="btn btn-danger btn-sm" v-on:click="deletePackage(module.p_id)" href="#">
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
                <form @submit.prevent="editMode ? updatePackage() :createPackage()">
                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 v-show="!editMode" class="modal-title" id="exampleModalLabel">New Package Create</h5>
                                    <h5 v-show="editMode" class="modal-title" id="exampleModalLabel">Update Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Package Name</span>
                                      </div>
                                      <input type="text" v-model="packages_info[0].p_name" class="form-control">
                                    </div>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Package Staus</span>
                                      </div>
                                      <select v-model="packages_info[0].p_status" class="form-control">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button v-show="!editMode" type="submit" class="btn btn-primary">Save</button>
                                    <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bootstrap Modal End -->
                </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            this.getAllPackages();
            this.getAdminId();
        },
        data() {
            return {
                admin: '',
                packages_info:[{}],
                packages_name: [],
                editMode:false,
                isEmpty:[],
            }
        },
        methods: {
            //Data Tables Functions Load Here 
            callDataTables(){
                $(document).ready(function() {
                    var table = $('#example1').DataTable({

                        dom: 'lBfrtip',
                        buttons: [
                            {
                                text: 'Download Excel',
                                extend: 'excel',
                                exportOptions: {
                                    columns: [ 0,1,2,3,4,5 ]
                                }
                            },
                            // 'colvis'
                        ]
                    });

                    $('.buttons-print ').addClass('btn btn-sm btn-primary');
                    $('.buttons-pdf ').addClass('btn btn-sm btn-primary');
                    $('.buttons-excel ').addClass('btn btn-sm btn-primary');


                    $('.dataTables_filter label').addClass('dt-search');
                    $('.dataTables_filter input').addClass('form-control form-control-sm data-search');
                    $('.paginate_button').addClass('btn btn-sm btn-info');
                    $('.paginate_button').removeClass('current');

                    $('#example1_paginate .paginate_button ').addClass('btn btn-sm btn-info');
                    $('#example1_paginate .paginate_button ').removeClass('current');


                    $('#example1_filter .data-search')
                       // .off()
                       .on('keyup', function() {
                          // axios.get('/all-services')
                          //   .then(({data})=>{this.services = data;});
                            // console.log("okk");
                    });
                } );
            },

    // Get Admin Id .....................!!!
            getAdminId(){
                axios.get('/admin')
                .then(({data})=>{
                    this.admin = data;
                })
                .catch();
            },
    /*Get All Packages Coding ............START*/
            getAllPackages() { 
                axios.get('/all-packages')
                .then(({data})=>{
                    this.packages_name = data;
                    this.callDataTables();
                    if (this.packages_name ==0) {
                        setTimeout(() => { this.packages_name = false; }, 2000);
                    }
                    this.isEmpty = this.packages_name;
                })
                .catch();                
            },
    /*Get All Packages Coding ............END*/
            addModePackage(){
                var pack_infos =[];
                pack_infos[0] = {
                    p_name:'', 
                    p_status:''
                };
                this.packages_info= pack_infos;
                this.editMode = false;
                $('#exampleModal').modal('show');
            },
    /*Create New Packages Coding ............START*/
            createPackage() { 
                var formData = this.packages_info;
                    formData[1] = {admin:this.admin};
                axios.post('/create-package',formData).then(()=>{
                    this.getAllPackages();
                    this.addModePackage();
                    $('#exampleModal').modal('hide');
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'New Package Create Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                })                
            },
    /*Create New Packages Coding ............END*/


    /*Edit Mode Packages End Functions ................!!*/
            editModePackage(id){
                let filterData = [];
                for (let i = 0; i < this.packages_name.length; i++) {
                    if (this.packages_name[i].p_id == id) {
                        filterData.push(this.packages_name[i]);
                    }
                }
                this.packages_info = filterData;
                this.editMode = true;
                $('#exampleModal').modal('show');
            },
            updatePackage(){
                var formData = this.packages_info;
                    formData[1] = {admin:this.admin};
                axios.post('/update-package',formData).then(()=>{
                    this.getAllPackages();
                    this.addModePackage();
                    $('#exampleModal').modal('hide');
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'Package Update Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
            },

            deletePackage(p_id){
                var id ={id:p_id};
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        console.log(id);
                        axios.post('/delete-package',id).then(({data})=>{
                            this.getAllPackages();
                            if (data == 'delete') {
                                Swal.fire({
                                    customClass: 'swal-height',
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Package Delete Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            else{
                                Swal.fire({
                                    // customClass: 'swal-height',
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: 'You Have Some Packages Data, You can not Delete This Package.',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                        });
                        
                    }
                })
            },
    /*Edit Mode Packages End Functions................!!*/
        },
        computed: {
        },
        
    }
</script>
