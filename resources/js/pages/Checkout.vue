<template>
    <div>
        <v-braintree 
            authorization="sandbox_w33jghkd_vcm26zyn62yxysh3"
            :card="{
                cardholderName: {
                    required: true
                }
            }"
            @success="onSuccess"
            @error="onError"
        ></v-braintree>
    </div>
</template>

<script>
export default {
    name: 'Checkout',
    data(){
        return{
            hostedFieldInstance: false,
        }
    },
    created(){

    },
    methods: {
        onSuccess (payload) {
            let nonce = payload.nonce;
            // Do something great with the nonce...
        },
        onError (error) {
            let message = error.message;
            // Whoops, an error has occured while trying to get the nonce
        }

    }

}

</script>

<style lang="scss">

</style>