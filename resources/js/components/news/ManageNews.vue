<template>
    <div>
        <create-news @newsCreated="getAllNews"></create-news>
        <h2>{{headline}}</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>headline</th>
                <th>img_name</th>
                <th>content</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>manage</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item,index) in news" :key="index">
                <td>{{item.id}}</td>
                <td @dblclick="editField(item.id, 'headline')">
                    <span v-if="editable.headline !== item.id">{{item.headline}}</span>
                    <input class="form-control" v-if="editable.headline === item.id" v-model="item.headline" @keydown.enter="updateField(item)" type="text">
                </td>
                <td>{{item.img_name}}</td>
                <td @dblclick="editField(item.id, 'content')">
                    <span v-if="editable.content !== item.id">{{item.content}}</span>
                    <input class="form-control" v-if="editable.content === item.id" v-model="item.content" @keydown.enter="updateField(item)" type="text">

                </td>
                <td>{{item.created_at}}</td>
                <td>{{item.updated_at}}</td>
                <td><button @click="deleteNews(item.id)" class="btn btn-danger">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import CreateNews from './CreateNews';
    export default {
        name: "ManageNews",
        components: {CreateNews},
        data() {
            return {
                headline: "Das ist meine Überschrift",
                editable: {
                  headline: null,
                  content: null
                },
                toSave: {},
                news: [
                    {
                        id: 1,
                        headline: 'Test',
                        content: 'Halllo Welt',
                        created_at: "DATUM",
                        updated_at: 'DATUM',
                        img_name: 'test.jpg'
                    }
                ]
            }
        },
        mounted() {
            this.getAllNews();

        },
        methods: {
            getAllNews() {
              axios.get('http://localhost:8000/api/news')
                  .then(res => {
                      this.news = res.data;
                  })
                  .catch(err => {
                      console.log(err);
                  })
            },

            editField(id, name) {
                this.editable[name] = id;
            },

            updateField(item){
                console.log(item);
                axios.put('http://localhost:8000/api/news/' + item.id, item)
                    .then(res => {
                        console.log(res);
                        this.$toast.success(`Eintrag mit der ID: ${item.id} wurde erfolgreich geändert`);
                        this.editable = {
                            headline: null,
                            content: null
                        };
                        this.getAllNews();
                    })
                    .catch(err => {
                        this.$toast.error('Eintrag konnte nicht geändert werden');
                        console.log(err);
                    })
            },

            deleteNews(id){
                axios.delete('http://localhost:8000/api/news/' + id)
                    .then(res => {
                        console.log(res);
                        this.$toast.success(`Eintrag mit der ID: ${id} wurde erfolgreich gelöscht`);
                        this.getAllNews();
                    })
                    .catch(err => {
                        this.$toast.error('Eintrag konnte nicht gelöscht werden');
                        console.log(err);
                    })
            }

        }
    }
</script>

<style scoped>

</style>