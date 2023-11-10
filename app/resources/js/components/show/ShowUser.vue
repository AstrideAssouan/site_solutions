<script>
import { getAdmin } from '../../services/authService';


export default {
    data(){
        return{
            data:[],
        }
    },
    mounted(){
        this.fetchData()
    },
    methods:{
        async fetchData(){
            const id = this.$route.params.id
            const response = await getAdmin(id)
            this.data = response
        }
    }
}
</script>

<template>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Admin</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informations détaillées sur l'admin</h6>
            </div>
            <div class="card-body">
                
                <div class="d-flex align-items-center">
                        <ul>
                            <li>Nom : {{ data.nom }}</li>
                            <li>Prénom : {{ data.prenom }}</li>
                            <li>Email : {{ data.email }}</li>
                            <li v-for="role in data.roles">Role : {{ role.nom_role }}</li>
                        </ul>
                </div>
            </div>
        </div>

    </div>
</template>