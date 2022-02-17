<template>
    <div >
        <h3 class="text-center">All Users</h3>
        <a class="btn btn-primary" @click="downloadExcel">Export Users</a>
        <table class="table table-responsive" @scroll="scrolledToBottom" style="overflow:scroll; max-height:264px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone }}</td>
                    <td>{{ user.location }}</td>
                    <td>{{ user.gender }}</td>
                    <td><img v-bind:src= user.image alt=""></td>
                    
                    <td>{{ user.created_at }}</td>
                    <td>{{ user.updated_at }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-primary">Edit
                            </router-link>
                            <!-- <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button> -->
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
                <!-- <infinite-loading @distance="1" @infinite="handleLoadMore"></infinite-loading> -->
    </div>
</template>
  
<script>
    export default {
        data() {
            return {
                users: [],
                nextPageUrl: 'http://127.0.0.1:8000/api/users',
                page: 1
            }
        },
        created() {
            this.handleLoadMore();
        },
        methods: {
            handleLoadMore() {
                this.axios
                .get(this.nextPageUrl) 
                .then(response => {
                    // this.users= response.data.data;
                     $.each(response.data.data, (key, value) => {
                            this.users.push(value);
                        });
                        // $state.loaded();
                        console.log(this.users, this.page);
                        // this.page = this.page + 1;
                    this.nextPageUrl = response.data.meta.next
                });
            },
            scrolledToBottom(event){
                var el = event.srcElement
                console.log(el.scrollTop + " " + el.scrollHeight + " " + el.clientHeight)
                if(!this.reachedBottom){
                    if(el.scrollTop >= (el.scrollHeight - el.clientHeight)-100){
                        // this.reachedBottom = true;
                        this.handleLoadMore();
                        // alert('here');
                    }
                } 
            },
            downloadExcel() {
                axios.get("/api/users/export").then(resp => {
                    this.loading = false;
                    window.open("/api/users/export", "users.xlxs", "_blank")
                });
            }
        }
    }
</script>