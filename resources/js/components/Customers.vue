<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Customer
                        <span class="float-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">+ New Customer</button>
                        </span>
                    </div>

<!---------------- Spinner Area START ---------------->
                    <div v-if="customers.length == 0 " class="card-body spninner-area">
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

                    <div v-if="customers.length > 0 " class="card-body">
                        
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Card No </th>
                                    <th>Phone </th>
                                    <th>Email </th>
                                    <th>Address </th>
                                    <th>DOB </th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(module,index) in customers">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ module.name }}</td>
                                    <td>{{ module.card_no }}</td>
                                    <td>{{ module.phone }}</td>
                                    <td>{{ module.email }}</td>
                                    <td>{{ module.address }}</td>
                                    <td>{{ module.dob }}</td>
                                    <td>
                                        <router-link :to="'/customers/view/'+module.id">
                                            <a class="btn btn-success btn-sm" href="#">
                                              <i class="fas fa-eye"></i>
                                            </a>
                                        </router-link>                                        
                                        <a class="btn btn-primary btn-sm" v-on:click="editCustomer(module.id)" href="#">
                                          <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a v-if="admin == 1" v-on:click="deleteCustomer(module.id)" class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash"></i>
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
<!-- --------------Add Customer Modal ----------------- -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <!-- <form @submit.prevent="createCustomers()"> -->
                                <form @submit.prevent="editMode ? updateCustomers() :createCustomers()">
                                    <div class="modal-header">
                                        <h5 v-show="!editMode" class="modal-title" id="exampleModalLabel">New Customer Create</h5>
                                        <h5 v-show="editMode" class="modal-title" id="exampleModalLabel">Edit Customer Informations</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-2 mt-2">
                                                    <label  for="">Name</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" v-model="customerInfo.name" class="form-control form-control-sm" required>
                                                </div>
                                                <div class="col-2">
                                                    <label for="">Card No</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" v-model="customerInfo.card_no" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-2 mt-2">
                                                    <label  for="">Date of Birth</label>
                                                </div>
                                                <div class="col-4" >
                                                    <input @mouseover="dobDatePic()" v-model="customerInfo.dob" type="text" class="form-control form-control-sm pull-right" id="datepicker" autocomplete="off">
                                                    <!--  -->
                                                </div>
                                                <div class="col-2 mt-2">
                                                    <label  for="">Card Issu Date</label>
                                                </div>
                                                <div class="col-4">
                                                    <input @mouseover="cardIssuDatePic()" v-model="customerInfo.card_issu_date" type="text" class="form-control form-control-sm pull-right" id="datepicker1" autocomplete="off">

                                                </div>
                                                <div class="col-2">
                                                    <label for="">Card Expire Date</label>
                                                </div>
                                                <div class="col-4">
                                                    <input @mouseover="cardExpDatePic()" v-model="customerInfo.card_expire_date" type="text" class="form-control form-control-sm pull-right" id="datepicker2" autocomplete="off">

                                                </div>
                                                <div class="col-2">
                                                    <label for="">Email</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" v-model="customerInfo.email" class="form-control form-control-sm" required>
                                                </div>
                                                <!--  -->
                                                <div class="col-2 mt-2">
                                                    <label  for="">Phone</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" v-model="customerInfo.phone" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-2">
                                                    <label for="">Address</label>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" v-model="customerInfo.address" class="form-control form-control-sm">
                                                </div>
                                                <!--  -->
                                                <div class="col-12">
                                                    <hr>
                                                    <h4>Package Details</h4>
                                                    <hr>
                                                </div>

                        <!-- Dynamic Packages System -->
                        <template v-for="(apackage,index) in allPackages">
                            <div v-if="apackage.p_status != 0 " class="col-2 mt-2">
                                <label  for="">{{ apackage.p_name }}</label>
                            </div>
                            <div v-if="apackage.p_status != 0 " class="col-4">
                                <input type="number" v-model="customerOffer[index]" class="form-control form-control-sm" placeholder="Offer in %">
                            </div>
                        </template>
                            
                        <!-- Dynamic Packages System End-->

                                                

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button v-show="!editMode" type="submit" class="btn btn-primary">Save</button>
                                        <button v-show="editMode" type="submit" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
 <!--  -----------Add Customer  Modal End ---------- -->
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                admin: '',
                updateCustomerId:'',
                allPackages:[],
                customerInfo:  {
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                    dob: '',
                    card_no: '',
                    card_issu_date: '',
                    card_expire_date: '',
                    admin:''
                },
                customerOffer:{},
                customers:[],
                allPackagesDiscount:[],
                selectRange :[],
                search: '',
                sortlist:'',
                editMode:false,
                isEmpty:[],
            }
        },
        mounted() {
            // console.log('Component mounted.');
            this.getCustomers();
            this.getAdminId();
            this.getAllPackages();
            this.getAllPackagesDiscount();
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
                                    columns: [0,1,2,3,4 ]
                                }
                            },
                            // {
                            //     extend: 'pdf',
                            //     exportOptions: {
                            //         columns: [ 0,1,2,3,4,5 ]
                            //     }
                            // },
                            // {
                            //     extend: 'excel',
                            //     exportOptions: {
                            //         columns: [ 0,1,2,3,4,5 ]
                            //     }
                            // },
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
                    this.customerInfo.admin = data;
                    this.admin = data;
                })
                .catch();
            },
    // Get All Customers Informations..........................!!!
            getCustomers(){
                axios.get('/all-customers')
                .then(({data})=>{
                    this.customers = data;
                    this.selectRange = data;
                    this.callDataTables();
                    if (this.customers ==0) {
                        setTimeout(() => { this.customers = false; }, 2000);
                    }
                    this.isEmpty = this.customers;
                })
                .catch();
            },
    // Get All Packages 
            getAllPackages(){
                axios.get('/all-packages')
                .then(({data})=>{
                    this.allPackages = data;
                    var len = this.allPackages.length;
                    // console.log(this.allPackages.length);
                    for (var i = 0; i <len; i++) {
                        this.customerOffer[i] = '';
                    }
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

    // Create New  Customers Informations..........................!!!

            dobDatePic(){
                $("#datepicker").datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "dd-M-yyyy"
                }).on(
                        "changeDate", () => {
                            this.customerInfo.dob = $('#datepicker').val()
                        }
                    );
            },
            cardIssuDatePic(){
                $("#datepicker1").datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "dd-M-yyyy"
                }).on(
                        "changeDate", () => {
                            this.customerInfo.card_issu_date = $('#datepicker1').val()
                        }
                    );
            },
            cardExpDatePic(){
                $("#datepicker2").datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "dd-M-yyyy"
                }).on(
                        "changeDate", () => {
                            this.customerInfo.card_expire_date = $('#datepicker2').val()
                        }
                    );
            },

            createCustomers(){

                var myObject = this.customerOffer;
                var count = Object.keys(myObject).length;

                this.customerOffer.length = count;
                var formData = this.customerInfo;
                var offerData = this.customerOffer;

                axios.post('/create-customer',formData).then(()=>{
                    $('#exampleModal').modal('hide');
                    this.getCustomers();
                    this.customerInfo =  {
                        name: '',
                        email: '',
                        phone: '',
                        address: '',
                        dob: '',
                        card_no: '',
                        card_issu_date: '',
                        card_expire_date: '',
                        admin:''
                    };
                    axios.post('/create-customer-offer',offerData).then(()=>{                
                        var len = this.allPackages.length;
                        this.customerOffer = {};
                        for (var i = 0; i <len; i++) {
                            this.customerOffer[i] = '';
                        }
                        Swal.fire({
                            customClass: 'swal-height',
                            position: 'top-end',
                            icon: 'success',
                            title: 'New Customer Insert Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });                        
                    })
                })
            },
        /* Create Customer End ...........!!*/

            editCustomer(id){
                
                let customerEdit = [];
                for (let i = 0; i < this.customers.length; i++) {
                    if (this.customers[i].id == id) {
                        // customerEdit.push('1');
                        customerEdit.push(this.customers[i]);
                    }
                }

                let packgDisc = [];
                for (let i = 0; i < this.allPackagesDiscount.length; i++) {
                    if (this.allPackagesDiscount[i].customer_id == id) {
                        packgDisc.push(this.allPackagesDiscount[i].discount_percentage);
                    }
                }
                this.customerInfo  = customerEdit[0];
                this.customerInfo['admin']  = this.admin;
                
                this.customerOffer      = packgDisc;
                this.updateCustomerId   = id;

                this.editMode = true;
                $('#exampleModal').modal('show');
            },
            updateCustomers(){
                var formData = this.customerInfo;
                axios.post('/update-customer',formData).then(()=>{
                    this.getCustomers();
                });

                var offerData = this.customerOffer;
                var offerDataUpdate         = {offerData};
                    offerDataUpdate['id']   = this.updateCustomerId;

                axios.post('/update-customer-offer',offerDataUpdate).then(()=>{
                    $('#exampleModal').modal('hide');
                    this.getCustomers();
                    Swal.fire({
                        customClass: 'swal-height',
                        position: 'top-end',
                        icon: 'success',
                        title: 'Customer Update Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            },
            deleteCustomer(id){
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
                        axios.post('/delete-customer',id).then(({data})=>{
                            this.getCustomers();
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
                                    title: 'You Have Some Customer Data, You can not Delete This Customer.',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                        });
                        
                    }
                })
                
            },
        },

        computed: {
        },

    }
</script>
