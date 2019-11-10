<template>
    <div>
        <Error :error="error" :toggle-error="toggleError"></Error>
        <form class="form" @submit.prevent="submit()">
            <input type="text" class="form-control-plaintext textField"
                   placeholder="Post a comment" required v-model="textField">
            <button :disabled="disabled" class="btn btn-success submit" type="submit">Post</button>
            <button :disabled="disabled" class="btn btn-dark submit" type="reset">Cancel</button>
        </form>
    </div>
</template>

<script>
    import Error from "../../error/Error";
    export default {
        name: "Form",
        components: {Error},
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
                error: '',
                toggleError: false,
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
                            console.log(response.data)
                        })
                        .catch(error => {});
                }else{
                    axios
                        .post('/comments', {
                            textField: this.textField,
                            id: this.id,
                            routeName: this.routename,
                        })
                        .then(response => {
                            if (response.data.error){
                                this.toggleError = !this.toggleError;
                                this.error = response.data.error;
                            } else {
                                this.name = '';
                                this.callReload(this.id);
                                this.textField = '';
                            }
                        })
                        .catch(error => {});
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "form";
</style>
