<template>
    <div class="total d-flex justify-content-center">
        <div class="row p-4 big_container mt-4 mb-4">
            <div class="col-8">
                <div class="my-form">
                    <!-- <form @submit="sendGuest"> -->
                        <div class="input-group mb-3 form-outline">
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
                    <template v-slot:button="slotProps">
                        <v-btn class="brain_btn" @click="slotProps.submit" color="success">Pay</v-btn>
                    </template>
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
        EventBus.$emit("close_cart");
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
                    this.lastname="";
                    this.phoneNumber="";
                    this.address="";
                }
                let params = {
                    name: this.firstname,
                    email: this.email,
                };
                this.firstname="";
                this.email="";
                EventBus.$emit("clear_cart");
                this.$router.push({ name: 'success', params: {data: params} });
                this.sending = false;
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
        },

    },
    watch: {
        list:
            function() {
                
            }
    }

}

</script>

<style lang="scss" scoped>
 .total {

    background-image: url("../../../public/images/background_y&o.jpg");
    // background-size: 300px 100px;
    background-position: center;
    .big_container {

        background-color: white;
        width: 60%;
        margin: 0 auto;
        
        .form-control {
            border: 1px solid grey
        }

        .form-control:focus {
        border-color: #ff4c31d6;   
        // box-shadow: inset 0 3px 3px rgba(0, 0, 0, 0.075), 0 0 8px #ff4d31;
        box-shadow:5px 10px 10px #ffc526c0;
        }
        
        .form-control::placeholder {
            color: grey;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #ffc526c0 inset !important;
            -webkit-text-fill-color: white !important;
        }



        .brain_btn {
            background-color: #ff4d31;
            margin-top: 1em;
            padding: 0.6em 1em;
            border-radius: 10px;
            color: white;
        }

        .brain_btn:hover {
            cursor: pointer;
        }
    }
 }
</style>