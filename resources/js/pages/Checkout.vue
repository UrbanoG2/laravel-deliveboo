<template>
    <div class="container">
        <div class="row p-4">
            <div class="col-8">
                <div class="my-form">
                    <!-- <form @submit="sendGuest"> -->
                        <div class="input-group mb-3">
                                <input type="text" v-model="firstname" class="form-control" placeholder="First Name" aria-label="firstname" aria-describedby="basic-addon1" id="firstname" >
                        </div>

                        <div class="input-group mb-3">
                            <input type="text"  v-model="lastname" class="form-control" placeholder="Last Name" aria-label="lastname" aria-describedby="basic-addon1" id="lastname" >
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" v-model="email" class="form-control" placeholder="Email" id="email"  aria-describedby="emailHelp">
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" v-model="address" class="form-control" placeholder="Address" aria-label="address" aria-describedby="basic-addon1" id="address" >
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" v-model="phoneNumber" class="form-control" placeholder="Telephone" aria-label="phoneNumber" aria-describedby="basic-addon1" id="phoneNumber" >
                        </div>
                        <!-- <button type="submit" class="btn btn-primary"></button> -->
                    <!-- </form> -->
                </div>
                <v-braintree 
                    authorization="sandbox_w33jghkd_vcm26zyn62yxysh3"
                    :card="{
                        cardholderName: {
                            required: true
                        }
                    }"
                    @success="onSuccess"
                    @error="onError"
                    
                >
                </v-braintree>
            </div>
            <div class="col-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in list" :key="index">
                            <td>{{item.name}}</td>
                            <td>{{item.quantity}}</td>
                            <td>{{item.price}}&euro;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import EventBus from "../bus.js";
export default {
    name: 'Checkout',
    data(){
        return{
            hostedFieldInstance: false,
            firstname: null,
            lastname: null,
            email: null,
            address: null,
            phoneNumber: null,
            success: false,
            sending: false,
            totPrice: null,
            list: null
        }
    },
    created(){
        this.list = JSON.parse(localStorage.getItem("cart"));
    },
    methods: {
        onSuccess (payload) {
            let nonce = payload.nonce;
            // Do something great with the nonce...
            this.sendGuest();
        },
        onError (error) {
            let message = error.message;
            // Whoops, an error has occured while trying to get the nonce
        },
        
        sendGuest(){
            this.sending = true;
            this.success = false;
            this.getTotPrice();
            axios.post('/api/guest', {
                'data': {
                    'guest': {
                        'firstname': this.firstname,
                        'lastname': this.lastname,
                        'email': this.email,
                        'phoneNumber': this.phoneNumber,
                        'address': this.address,
                    },
                    'infocart': {
                        'cart': this.list
                    },
                    'price': {
                        'totalPrice': this.totPrice,
                    }
                }
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
                    this.firstname="";
                    this.email="";
                    this.lastname="";
                    this.phoneNumber="";
                    this.address="";
                }
                this.sending = false;
                EventBus.$emit("clear_cart");
                this.$router.push({ name: 'success' });
             })
             .catch(error=>{
                 console.log(error.response.data);
                 this.sending = false;
             })
        },
        getTotPrice() {
            this.list.forEach(element => {
                this.totPrice += element.price;
            });
        }

    },
    watch: {
        list:
            function() {
                
            }
    }

}

</script>

<style lang="scss">

</style>