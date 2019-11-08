<template>
    <form class="form" @submit.prevent="submit()">
        <input type="text" class="form-control-plaintext textField"
               placeholder="Post a comment" required minlength="8" v-model="textField">
        <button :disabled="disabled" class="btn btn-success submit" type="submit">Post</button>
        <button :disabled="disabled" class="btn btn-dark submit" type="reset">Cancel</button>
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
            routename: {
                default: 'home',
                type: String
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
                if(this.reply){
                    axios
                        .post('/replies', {
                            textField: this.textField,
                            id: this.id,
                        })
                        .then(response => {
                            this.name = '';
                            this.callReload(this.id);
                            this.textField = '';
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }else{
                    axios
                        .post('/comments', {
                            textField: this.textField,
                            id: this.id,
                            routeName: this.routename,
                        })
                        .then(response => {
                            this.name = '';
                            this.callReload(this.id);
                            this.textField = '';
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "form";
</style>
