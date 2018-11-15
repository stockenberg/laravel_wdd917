<template>
    <div>
        <button @click="isVisible = !isVisible" class="btn btn-info">Create news</button>
        <transition name="fade">
            <form action="" method="post" role="form" v-if="isVisible">
                <legend>Form Title</legend>

                <div class="form-group">
                    <label for="">Headline</label>
                    <input type="text" v-model="form.headline" class="form-control" name="headline" id="" value="" placeholder="Input...">
                </div>
                <p v-if="formErrors.headline">{{formErrors.headline}}</p>

                <!--
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="img" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div> -->

                <div class="form-group">
                    <textarea name="content" v-model="form.content" id="" cols="30" class="form-control" rows="10"></textarea>
                </div>
                <p v-if="formErrors.content">{{formErrors.content}}</p>


                <button @click.prevent="createNews" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "CreateNews",
        data () {
            return {
                isVisible: false,
                form: {
                    headline: null,
                    content: null
                },
                formErrors: {
                    headline: null,
                    content: null
                }
            }
        },
        methods: {
            createNews() {
                this.formErrors = {
                    headline: null,
                    content: null
                };

                axios.post('http://localhost:8000/api/news', this.form)
                    .then(res => {
                        console.log(res);
                        this.form.headline = null;
                        this.form.content = null;
                        this.$toast.success(res.data);
                        this.isVisible = false;
                        this.$emit('newsCreated');
                    })
                    .catch(err => {
                        console.dir(err.response.data);
                        this.$toast.error(err.message);
                        this.formErrors.headline = err.response.data.errors.headline[0];
                        this.formErrors.content = err.response.data.errors.content[0];
                    })
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>