<template>
    <form @submit.prevent="submit()">
        <input type="text" class="form-control" placeholder="Įveskite komentarą" v-model="textField">
        <button class="btn btn-success" type="submit">Paskelbti</button>
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
            }
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
