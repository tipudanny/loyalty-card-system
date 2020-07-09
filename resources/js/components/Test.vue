<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Items 
                        <span class="float-right"><button class="btn btn-sm btn-info">+ New Item</button></span>
                    </div>

                    <div class="card-body">
                      This Is Card Body
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
  import { mdbDatatable } from 'mdbvue';
  export default {
    mounted() {
        console.log('Component mounted.')
    },
    components: {
      mdbDatatable,
    },

    data() {
      return {
        data: {
        }
      }
    }
  }
</script>
