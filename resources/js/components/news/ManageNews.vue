<template>
    <div>
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
                <td>{{item.headline}}</td>
                <td>{{item.img_name}}</td>
                <td>{{item.content}}</td>
                <td>{{item.created_at}}</td>
                <td>{{item.updated_at}}</td>
                <td><button @click="deleteNews(item.id)" class="btn btn-danger">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ManageNews",
        data() {
            return {
                headline: "Das ist meine Überschrift",
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
            deleteNews(id){
                axios.delete('http://localhost:8000/api/news/' + id)
                    .then(res => {
                        console.log(res);
                        this.getAllNews();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }

        }
    }
</script>

<style scoped>

</style>