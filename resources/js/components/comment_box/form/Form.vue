<template>
    <form class="form" @submit.prevent="submit()">
        <input type="text" class="form-control-plaintext textField" placeholder="Post a comment" v-model="textField">
        <button :disabled="disabled" class="btn btn-success submit" type="submit">Post</button>
        <button :disabled="disabled" class="btn btn-dark submit" type="submit">Cancel</button>
    </form>
</template>

<script>
    export default {
        name: "Form",
        props: {
            reply: {
                default: false,
                type: Boolean
            },
            callReload: {
                type: Function
            },
            id: {
                default: 1,
                type: Number
            },
            disabled: {
                default: true,
                type: Boolean
            },
        },
        data() {
            return {
                comments: [],
                textField: "",
            }
        },
        methods: {
            submit(){
                axios
                    .post('/comments', {
                        textField: this.textField,
                        reply: this.reply,
                        id: this.id
                    })
                    .then(response => {
                        this.name = '';
                         this.callReload();
                         this.textField = '';
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "form";
</style>
