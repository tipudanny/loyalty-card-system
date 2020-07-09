<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Dashboard  Component</div>

                    <div class="card-body">
                        <div class="row">
                          <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                              <div class="inner">
                                <h3>{{newCustomer}}</h3>

                                <p>New Customer</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="#" class="small-box-footer">This Month <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                              <div class="inner">
                                <h3>{{totalCustomer}}<sup style="font-size: 20px"></sup></h3>

                                <p>Total Customer</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                              </div>
                              <a href="#" class="small-box-footer">All Time <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                              <div class="inner">
                                <h3>{{newService}}</h3>

                                <p>New Service</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-person-add"></i>
                              </div>
                              <a href="#" class="small-box-footer">This Month <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                              <div class="inner">
                                <h3>{{totalService}}</h3>

                                <p>Total Service</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                              </div>
                              <a href="#" class="small-box-footer">All Time <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->
                        </div>
                    </div>
                </div>
            
              <div class="row">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>

                      <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's
                      content.
                      </p>

                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>

                      <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's
                      content.
                      </p>

                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
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
        mounted() {
            this.getNewCustomer();
            this.getTotalCustomer();
            this.getServices();
            this.getTotalService();
        },
        data() {
            return {
              newCustomer:0,
              totalCustomer:0,
              newService:0,
              totalService:0,
            }
        },
        methods: {
            getNewCustomer()
            {
                axios.get('/count-new-customer')
                .then(({data})=>{
                    this.newCustomer = data;
                })
                .catch();
            },
            getTotalCustomer()
            {
                axios.get('/count-total-customer')
                .then(({data})=>{
                    this.totalCustomer = data;
                })
                .catch();
            },
            getServices()
            {
                axios.get('/count-new-service')
                .then(({data})=>{
                    this.newService = data;
                })
                .catch();
            },
            getTotalService()
            {
                axios.get('/count-total-service')
                .then(({data})=>{
                    this.totalService = data;
                })
                .catch();
            },
        }
    }
</script>
