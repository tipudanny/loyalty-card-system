<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Services
                        <span class="float-right">
                            <button class="btn btn-sm btn-success" v-on:click="newServiceModal()">+ New Service</button>
                        </span>
                    </div>

<!---------------- Spinner Area START ---------------->
                    <div v-if="services.length == 0 " class="card-body spninner-area">
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

                    <div v-if="services.length > 0 " class="card-body">
                        <table id="example1" class="table table-bordered table-striped packg-table text-center">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Service Packge</th>
                                    <th>Bill No.</th>
                                    <th>Discount</th>
                                    <th>Remarks</th>
                                    <th>Create By</th>
                                    <th>Update By</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(service,index) in services">
                                    <td >{{ index+1 }}</td>
                                    <td >{{ service.service_date }}</td>
                                    <td >{{ service.c_name }}</td>
                                    <td >{{ service.p_name }}</td>
                                    <td >{{ service.bill_no }}</td>
                                    <td >{{ service.service_discount }} %</td>
                                    <td >{{ service.remark }}</td>
                                    <td >{{ service.create_user }}</td>
                                    <td >{{ service.update_user }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm" v-on:click="editServiceModal(service.id)" href="#">
                                          <i class="fas fa-pencil-alt"></i>  Edit
                                        </a>
                                        <a v-if="admin == 1" v-on:click="deleteService(service.id)" class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash"></i>  Delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <!-------------------- New Service Modal Area START ---------------------------->
                        <form @submit.prevent="editMode ? updateService() :createService()">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 v-show="!editMode" class="modal-title" id="exampleModalLabel">New Service Creation</h5>
                                        <h5 v-show="editMode" class="modal-title" id="exampleModalLabel">Update Service Informations</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-2 mt-2">
                                                    <label  for="">Date</label>
                                                </div>
                                                <div class="col-4" @mouseover="serviceDate()">
                                                    <input v-model="service_info[0].service_date" type="text" class="form-control form-control-sm" required id="datepicker" autocomplete="off">
                                                </div>
                                                <div class="col-2">
                                                    <label for="">Customer</label>
                                                </div>
                                                <div class="col-4">
                                                    <!-- <select  
                                                        v-model="service_info[0].customer_id" 
                                                        v-on:click="find_pakg_discount()" 
                                                        class="form-control form-control-sm">
                                                        <template v-for="customer in customers">
                                                            <option v-bind:value="customer.id">{{customer.name}}</option>
                                                        </template>                      
                                                    </select> -->

                                                    <v-select
                                                        v-model="service_info[0].customer_id" 
                                                        :options="customers"
                                                        :get-option-label="option => option.name"
                                                        :reduce="option => option.id"
                                                        @input="find_pakg_discount"
                                                        >
                                                    </v-select>

                                                </div>
                                                <!-- Dynamic Packages System -->
                                                <template >
                                                    <div class="col-2 mt-2">
                                                        <label  for="">Package Name</label>
                                                    </div>
                                                    <div class="col-4">

                                                        <!-- <select 
                                                        v-model="service_info[0].package_id" 
                                                        v-on:click="find_pakg_discount()" 
                                                        class="form-control form-control-sm">
                                                            <template v-for="pakg in packages">
                                                                <option  v-bind:value="pakg.p_id">{{pakg.p_name}}</option>
                                                            </template>
                                                        </select> -->

                                                        <v-select
                                                            v-model="service_info[0].package_id" 
                                                            :options="packages"
                                                            :get-option-label="option => option.p_name"
                                                            :reduce="option => option.p_id"
                                                            @input="find_pakg_discount"
                                                            >
                                                        </v-select>


                                                    </div>
                                                </template>                            
                                                <!-- Dynamic Packages System End-->
                                                <!--  -->
                                                <div class="col-2 mt-2">
                                                    <label  for="">Amount</label>
                                                </div>
                                                <div class="col-4">
                                                    <input v-model="service_info[0].amount" type="text" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-2">
                                                    <label for="">Discount</label>
                                                </div>
                                                <div class="col-4">
                                                    <input v-model="service_info[0].service_discount" type="text" class="form-control form-control-sm" readonly="true">
                                                </div>
                                                <!--  -->
                                                <div class="col-2 mt-2">
                                                    <label  for="">Remarks</label>
                                                </div>
                                                <div class="col-4" >
                                                    <input v-model="service_info[0].remark" type="text" class="form-control form-control-sm" required autocomplete="off">
                                                </div>
                                                <!--  -->
                                            </div>
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
                    </form>
    <!-------------------- New Service Modal Area END ------------------------------>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getAdminId();
            this.getAllServices();
            this.getAllPackages();
            this.getCustomers();
            this.getAllPackagesDiscount();
        },
        data() {
            return {
                admin: '',
                service_info:[{}],
                services: [],
                packages: [],
                customers: [],
                allPackagesDiscount: [],
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
            // Date Picker For Service Date
            serviceDate(){
                $("#datepicker").datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "dd-M-yyyy"
                }).on(
                        "changeDate", () => {
                            this.service_info[0].service_date = $('#datepicker').val()
                        }
                    );
            },

            // Get Admin Id .....................!!!
            getAdminId(){
                axios.get('/admin')
                .then(({data})=>{
                    this.admin = data;
                })
                .catch();
            },
            getCustomers(){
                axios.get('/all-customers')
                .then(({data})=>{
                    this.customers = data;
                })
                .catch();
            },
            getAllServices(){
                axios.get('/all-services')
                .then(({data})=>{
                    this.services = data;
                    this.callDataTables();
                    if (this.services ==0) {
                        setTimeout(() => { this.services = false; }, 2000);
                    }
                    this.isEmpty = this.services;
                })
                .catch();
            },
            getAllPackages() { 
                axios.get('/all-packages')
                .then(({data})=>{
                    this.packages = data;
                })
                .catch();                
            },
            getAllPackagesDiscount()
            {
                axios.get('/all-packages-discount')
                .then(({data})=>{
                    this.allPackagesDiscount = data;
                })
                .catch();
            },
    /*.................New Service Modal Area ..........!!*/
            newServiceModal(){
                this.editMode = false;
                var new_service =[];
                new_service[0] = {

                    customer_id:'',
                    package_id:'',
                    service_discount:'',
                    amount:'',
                    service_date:'',
                    remark:''

                    };
                this.service_info = new_service;
                $('#exampleModal').modal('show');
            },
            find_pakg_discount(){
                let p_disc = [];
                for (let i = 0; i < this.allPackagesDiscount.length; i++) {
                    if ( this.allPackagesDiscount[i].package_id == this.service_info[0]['package_id'] && this.allPackagesDiscount[i].customer_id == this.service_info[0]['customer_id'] ) {
                        p_disc.push(this.allPackagesDiscount[i].discount_percentage);
                    }
                }
                this.service_info[0]['service_discount'] = p_disc[0];
                this.service_info[0]['admin'] = this.admin;
                // console.log(p_disc);

                
            },

            createService(){
                var serviceData = this.service_info;
                axios.post('/create-service',serviceData).then(()=>{
                    serviceData = [];
                    $('#exampleModal').modal('hide');
                    this.getAllServices();
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'New Service Create Successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                });
            },
/*.................New Service Modal Area ..........!!*/

            editServiceModal(id){
                this.editMode = true;
                let serviceEdit = [];
                for (let i = 0; i < this.services.length; i++) {
                    if (this.services[i].id == id) {
                        serviceEdit.push(this.services[i]);
                    }
                }
                this.service_info = serviceEdit;
                $('#exampleModal').modal('show');
                // console.log(id);
            },

            updateService(){
                var serviceData = this.service_info;
                    serviceData[0]['admin'] = this.admin;
                axios.post('/update-service',serviceData).then(()=>{
                    serviceData = [];
                    $('#exampleModal').modal('hide');
                    this.getAllServices();
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'New Service Create Successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }).catch();
                // console.log("this is Update Function");
            },
            deleteService(id){
                var id ={id:id};
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
                        axios.post('/delete-service',id).then(({data})=>{
                            this.getAllServices();
                            if (data == 'delete') {
                                Swal.fire({
                                    customClass: 'swal-height',
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Customer Delete Successfully',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                            else{
                                Swal.fire({
                                    // customClass: 'swal-height',
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: 'Something Error !! Try Again',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                        });
                        
                    }
                })

            },
        }
    }
</script>
