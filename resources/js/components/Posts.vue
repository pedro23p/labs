<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Dados</h5>
                <div>
                    <button class="btn btn-success" type="button" @click="this.$router.push('/posts/add')">Nova Tarefa</button>
                </div>
            </div>
            
            <table class="table table-hover table-sm">
                <thead class="bg-dark text-light">
                    <tr>
                        <th width="50" class="text-center">#</th>
                        <th>Tarefa</th>
                        <th>Descrição</th>
                        <th>Situação</th>
                        <th class="text-center" width="200">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(post, index) in posts" :key="post.id">
                        <td class="text-center">{{index+1}}.</td>
                        <td>{{post.name}}</td>
                        <td>{{post.description}}</td>
                        <td>{{post.situation}}</td>
                        <td class="text-center">
                            <router-link :to="{name:'editpost', params: {id:post.id}}" class="btn btn-warning">Editar tarefa</router-link>
                            <button class="btn btn-danger" @click="deletePost(post.id)">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
    
    
        </div>
    </div>
    
    


    </template>
    
    <script>
        export default {
            data() {
                return {
                    posts: [],
                    strSuccess: '',
                    strError: ''
                }
            },
            created() {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.get('/api/posts')
                    .then(response => {
                        this.posts = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                });
            },
            methods: {
                deletePost(id) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                        let existingObj = this;
                        if(confirm("Almeja realmente excluir?")) {
                            this.$axios.delete(`/api/posts/delete/${id}`) //setar corretamtn na route/contrllr
                            .then(response => {
                                let i = this.posts.map(item => item.id).indexOf(id); // Ecnontrar o index específico
                                this.posts.splice(i, 1);
                                existingObj.strError = "";
                                existingObj.strSuccess = response.data.success;
                            })
                            .catch(function(error) {
                                existingObj.strError = "";
                                existingObj.strSuccess = error.response.data.message;
                            });
                        }
                    });
                }
            },
            beforeRouteEnter(to, from, next) {
                if (!window.Laravel.isLoggedin) {
                    window.location.href = "/";
                }
                next();
            }
        }
        //seta as diretivas do vue 
        //olhar de exemplos anteriores a implementação do axios novamente
        //Analisar quais LH usar 
        //pega de exemplo bootstrapt do primeiro prjeto e adequa c as diretiva do vue 
        //.$router.push
    </script>

