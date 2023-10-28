<script>
import AddCategorieModal from '../components/modal/AddCategorieModal.vue';
import { getCategories, deleteCategorie } from '../services/gestionServices';

export default {
    components: {
        AddCategorieModal,
    },
    data() {
        return {
            data: [],
            isLoading:false,
        }
    },
    mounted(){
        this.fetchData()
    },
    methods:{
        async fetchData(){
            try {
                const response = await getCategories()
                this.data = response
            } catch (error) {
                console.log(error.message);
            }
        },
        nouvelleEntreeAjoutee() {
            this.fetchData()
        },
        async deleteData(id) {
            this.isLoading = true
            try {
                const response = await deleteCategorie(id)
                if (response.status === 200) {
                    this.isLoading = false
                    this.fetchData()
                }
            } catch (error) {
                console.log(error);
                this.isLoading = false
            }
        },
    }
}
</script>

<template>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Categories</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des categories</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#publicModal">Ajouter une categorie</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Intitulé des categories</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in data" :key="index">
                                <td>{{ row.libelle_cat }}</td>
                                <td class="d-flex align-items-center">
                                    <button class="btn btn-warning mx-3" @click="$router.push(`/back-office/categorie/edit/${row.id}`)"><i class="bx bx-edit"></i></button>
                                    <button class="btn btn-danger" :disabled="isLoading" @click="deleteData(row.id)"><i class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <AddCategorieModal @nouvelleEntreeAjoutee="nouvelleEntreeAjoutee" />
</template>