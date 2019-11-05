<template>
    <form @submit="formSubmit">
        <input type="text" class="form-control" placeholder="Įveskite vardą" v-model="name">
        <button class="btn btn-success">Submit</button>
    </form>
</template>

<script>
    export default {
        name: "Form",
        data() {
            return {
                comments: [],
                name: '',
            }
        },
        mounted() {

        },
        methods: {
            formSubmit(e){
                e.preventDefault();
                axios
                    .post('/comments', {
                        comment: this.comment
                    })
                    .then(response => {
                        this.comments = response.data.comments;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
        }

    }
</script>

<style lang="scss" scoped>
    @import "form";
</style>
