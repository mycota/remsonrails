<template>

    <div class="wrap">
        <a :href="quotUrl">
            {{unread.data.user.name}} have created new <strong>Quotation</strong>
        </a>
    </div>

</template>

<script>

    export default {
        props:['unread'],
        data(){
            return {
                quotUrl: ''
            }
        },

        mounted() {
            this.quotUrl = `http://localhost/remsonrails/public/quotations/quot_gen/${this.unread.data.order.id}/generatequot`
        }
    }
</script>
