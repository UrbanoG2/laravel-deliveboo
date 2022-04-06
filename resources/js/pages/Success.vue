<template>
  <div class="container">
    <div v-if="success" class="alert alert-success" role="alert">
        Mail inviata con successo!
    </div>
    

  </div>
</template>

<script>
export default {
    name:"Success",
    props: ['data'],
      data(){
      return {
          message: "l'ordine è in stato di elaborazione",
          success: false,
          sending: false,
          errors: {}
      }
    },

    created() {
        console.log(this.data);
        this.sendForm();
    },

    methods:{
    sendForm(){
        this.sending = true;
        this.success = false;
        axios.post('/api/success', {
        'name': this.data.name,
        'email': this.data.email,
        'message': this.message
        })
        .then(response=>{
            console.log(response.data);
            if(!response.data.success){
                this.success = false;
                this.errors = response.data.errors;
            }
            else{
                this.success = true;
                this.errors = {};
                this.message="";
            }
            this.sending = false;
        })
        .catch(error=>{
            console.log(error.response.data);
            this.sending = false;
        })
    }
     }
}
</script>

<style>

</style>