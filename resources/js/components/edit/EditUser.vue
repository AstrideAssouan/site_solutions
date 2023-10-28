<script>
import { getRole, getAdmin, editAdmin } from '../../services/authService';


export default {
    data() {
        return {
            data: {
                nom: '',
                prenom: '',
                email: '',
                role:null,
            },
            role: [],
            isLoading: false
        }
    },
    mounted() {
        this.fetchData()
        this.fetchRole()
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
            const response = await getAdmin(id)
            this.data={
                nom: response.nom,
                prenom: response.prenom,
                email: response.email,
                role:response.roles[0].nom_role,
            }
        },
        async fetchRole() {
            const response = await getRole()
            this.role = response
        },
        async editData() {
            this.isLoading = true
            try {
                const id = this.$route.params.id
                const response = await editAdmin(this.data, id)
                if (response.status === 200) {
                    this.isLoading = false
                    this.sweetAlert('success', response.message)
                    this.$router.push('/back-office/user')
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

        <h1 class="h3 mb-2 text-gray-800">Administration</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modification d'un admin</h6>
            </div>
            <div class="card-body">

                <form @submit.prevent="editData">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" v-model="data.nom" id="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" v-model="data.prenom" id="prenom"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Tarif</label>
                        <input type="email" class="form-control" v-model="data.email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" required id="role" v-model="data.role">
                            <option v-for="(row, index) in role" :key="index" :value="row.nom_role">{{
                                row.nom_role }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" :disabled="isLoading">Enregistrer</button>
                </form>
            </div>
        </div>

    </div>
</template>