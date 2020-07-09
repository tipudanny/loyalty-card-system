<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card  mt-3">
                    <div class="card-header">User Name</div>

                    <div class="card-body">
                        <center>
                            <h5><i><b>User Info</b></i></h5>
                        </center>
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
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
                                <tr >
                                    <td>{{ findCustomer.name }}</td>
                                    <td>{{ findCustomer.card_no }}</td>
                                    <td>{{ findCustomer.phone }}</td>
                                    <td>{{ findCustomer.email }}</td>
                                    <td>{{ findCustomer.address }}</td>
                                    <td>{{ findCustomer.dob }}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="#">
                                          <i class="fas fa-eye"></i>
                                        </a>                                      
                                        <a class="btn btn-primary btn-sm" href="#">
                                          <i class="fas fa-pencil-alt"></i>
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
                        <center class="mt-4 mb-3">
                            <h5><i><b>Package Info</b></i></h5>
                        </center>
                        <table  class="table table-bordered table-striped packg-table text-center">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Package Name</th>
                                    <th>Package Parcentage</th>
                                    <th width="25%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(module,index) in allPackagesDiscount">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ module.p_name }}</td>
                                    <td>{{ module.discount_percentage}} %</td>
                                    <td class="text-center">
                                        <a v-on:click="customerDetails(module.package_id)" class="btn btn-success btn-sm" href="#">
                                          <i class="fas fa-eye"></i>  Details
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Details View Modals Customer START -->

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><span class="packg-de">Room</span> Service = 10 Times</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example1" class="table table-bordered table-striped packg-table text-center">
                                            <thead>
                                                <tr>
                                                    <th>#SL</th>
                                                    <th>Bill No.</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(service,index) in filterCustomerService">
                                                    <td>{{ index+1 }}</td>
                                                    <td>{{ service.bill_no }}</td>
                                                    <td>{{ service.service_date }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details View Modals Customer END-->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getCustomers();
            this.getCustomerService();
            this.customerPackagesDiscount();
        },
        data(){
            return {
                id: this.$route.params.id,
                findCustomer:{},
                customers:[],
                customerService:[],
                filterCustomerService:[],
                getTotalService:[],
                allPackagesDiscount:[],
            }
        },
        methods:{
            getCustomerService(){
                var postData ={'id': parseInt(this.id)};
                let ttl_service = [];
                axios.post('/customer-service',postData)
                .then(({data})=>{
                    this.customerService = data;
                });
            },

    // Get All Customers Informations..........................!!!
            getCustomers(){
                axios.get('/all-customers')
                .then(({data})=>{
                    this.customers = data;
                    // this.findCustomer = this.customers;

                    let customerEdit = [];
                    for (let i = 0; i < this.customers.length; i++) {
                        if (this.customers[i].id == parseInt(this.id)) {
                            customerEdit.push(this.customers[i]);
                        }
                    }
                    this.findCustomer  = customerEdit[0];

                });

            },
            customerPackagesDiscount()
            {
                var postData ={'id': parseInt(this.id)};

                axios.post('/customer-packages-discount',postData)
                .then(({data})=>{
                    this.allPackagesDiscount = data;
                });
            },

            customerDetails(id)
            {   
                let filterService = [];
                var len = this.customerService.length;
                for (var i = 0; i < len; i++) {
                    if (this.customerService[i].package_id == id) {
                        filterService.push(this.customerService[i]);
                    }
                }
                this.filterCustomerService = filterService;
                $('#exampleModal').modal('show');
            },
        }

    }
</script>
