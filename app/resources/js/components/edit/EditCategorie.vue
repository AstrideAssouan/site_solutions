<script>
import { getCategorie, editCategorie } from '../../services/gestionServices';


export default {
    data() {
        return {
            data: {
                libelle_cat: ''
            },
            isLoading: false,
        }
    },
    mounted() {
        this.fetchData()
    },
    methods: {
        sweetAlert(icon, message) {
            this.$swal.fire({
                icon: icon,
                text: message,
            })
        },
        async fetchData() {
            const id = this.$route.params.id
            const response = await getCategorie(id)
            this.data = {
                libelle_cat: response.libelle_cat
            }
        },
        async editData() {
            this.isLoading = true
            try {
                const id = this.$route.params.id
                const response = await editCategorie(this.data, id)
                if (response.status === 200) {
                    this.isLoading = false
                    this.sweetAlert('success', response.message)
                    this.$router.push('/back-office/categorie')
                } else {
                    this.isLoading = false
                    this.sweetAlert('error', response.message)
                }
            } catch (error) {
                this.isLoading = false
                this.sweetAlert('error', error.message)
            }
        },
    }
}
</script>

<template>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Catégorie</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modification d'une catégorie</h6>
            </div>
            <div class="card-body">

                <form @submit.prevent="editData">
                    <div class="mb-3">
                        <label for="libelle_cat" class="form-label">Libellé de la catégorie</label>
                        <input type="text" class="form-control" id="libelle_cat" v-model="data.libelle_cat"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary" :disabled="isLoading">Enregistrer</button>
                </form>
            </div>
        </div>

    </div>
</template>