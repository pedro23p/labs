<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Adicionar</h5>
                <div>
                    <router-link :to="{name: 'posts'}" class="btn btn-success">Retornar</router-link>
                </div>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strSuccess}}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>


            <form @submit.prevent="addPost" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label>Tarefa</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Nome">
                </div>

                <div class="form-group mb-2">
                    <label>Descrição</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="description" placeholder="Descrição da tarefa"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label>Situação</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="situation" placeholder="Pendente ou concluído?"></textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-4"> Adicionar tarefa</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            name: '',
            description: '',
            situation:'',
            strSuccess: '',
            strError: '',
        }
    },
    methods: {
        addPost(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('situation', this.situation);
                this.$axios.post('/api/posts/add', formData, config)
                .then(response => {
                    existingObj.strError = "";
                    existingObj.strSuccess = response.data.success;
                })
                .catch(function(error) {
                    existingObj.strSuccess ="";
                    existingObj.strError = "Preencha todos os campos!";
                });
            });
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
    //Olhar aplicações anteriores c axios (ATENÇÂO)
//corrigir e adeuquaisr as info
}


</script>
